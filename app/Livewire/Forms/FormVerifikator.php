<?php

namespace App\Livewire\Forms;

use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Models\JenisKeteranganPemohon;
use App\Models\KeteranganDetailUploadPemohon;
use App\Models\Notification;
use App\Models\VerifikatorHasPengajuan;
use App\Traits\WithModelValue;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormVerifikator extends Component
{
    use WithFileUploads;
    use WithSweetAlert;
    use WithModelValue;
    public $rules = [];
    public $messages = [];
    public $file_koreksi;
    public $input_keterangan_sesuai = [], $input_catatan_gambar = [];
    public $ldok; //history
    public $data; //history
    public $status_dokumen;
    public $uniqueId;
    #[Locked]
    public $dok_name;

    #[Locked]
    public $type_dok; //history
    public function mount($id, $type_dok)
    {
        $this->data = DetailPemohon::find($id);
        $this->type_dok = $type_dok;
        $this->setInputDefault();
        $this->uniqueId = Str::random(8);
        $this->dok_name = DokumenPemohon::find($type_dok)?->nama_file;
        // $this->ensureVerifikatorAccess();
    }
    public function render()
    {
        return view('livewire.forms.form-verifikator');
    }
    public function setInputDefault()
    {
        $this->ldok = $this->data->LatestDokumenUser($this->type_dok); //history
        foreach ($this->JenisKeteranganDokumen() as $key => $v) {
            $dk = KeteranganDetailUploadPemohon::where('dokumen_upload_id', $this->ldok->id)->where('jenis_keterangan', $v->id)->first();
            if ($dk != null) {
                $this->input_keterangan_sesuai[$v->kode] = $dk->kesesuaian;
                $this->input_catatan_gambar[$v->kode] = $dk->catatan;
            } else {
                $this->input_keterangan_sesuai[$v->kode] = null;
                $this->input_catatan_gambar[$v->kode] = null;
            }
        }
    }
    #[Computed]
    public function JenisKeteranganDokumen()
    {
        return JenisKeteranganPemohon::where('dokumen_type_id', $this->type_dok)->get();
    }
    #[Computed]
    public function GetCollectionName()
    {
        return DokumenPemohon::find($this->type_dok)->nama_file;
    }
    public function checkAll()
    {
        foreach ($this->JenisKeteranganDokumen() as $key => $v) {
            $dk = KeteranganDetailUploadPemohon::where('dokumen_upload_id', $this->data->id)->where('jenis_keterangan', $v->id)->first();
            $this->input_keterangan_sesuai[$v->kode] = true;
        }
    }
    #[Computed]
    public function GetKeteranganDokumen($id)
    {
        $data_keterangan = KeteranganDetailUploadPemohon::where('dokumen_upload_id', $this->ldok->id)->where('jenis_keterangan', $id)->latest()->first();
        return $data_keterangan;
    }
    public function saveCatatanDokumen(): void
    {
        $this->validate();

        $statusText = config('styles.status_upload.' . $this->status_dokumen . '.text');

        // munculkan konfirmasi, kalau "Ya" maka panggil h_svd()
        $this->confirm(
            method: 'h_svd',
            params: [], // kalau perlu kirim parameter -> ['id' => 123, ...]
            swal: [
                'title' => 'Apa Kamu Yakin Dengan Catatan Yang Diberikan Secara Keseluruhan?',
                'text' => 'Dokumen akan diteruskan ke pemohon dengan status: ' . $statusText,
                'icon' => 'warning',
            ],
        );
    }
    public function h_svd()
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            $this->ldok->status = $this->status_dokumen;
            $this->ldok->keterangan = $this->details_keterangan ?? null;
            $this->ldok->verified_by_user_id = auth()->user()->id;
            $this->ldok->verified_at = now();
            $this->ldok->save();
            foreach ($this->JenisKeteranganDokumen() as $key => $v) {
                $save = KeteranganDetailUploadPemohon::updateOrCreate(
                    [
                        'dokumen_upload_id' => $this->ldok->id,
                        'jenis_keterangan' => $v->id,
                    ], [
                        'catatan' => $this->input_catatan_gambar[$v->kode] ?? null,
                        'kesesuaian' => $this->input_keterangan_sesuai[$v->kode] ?? false,
                        'checked_by_user_id' => auth()->user()->id,
                    ]);
            }

            $vp = VerifikatorHasPengajuan::where([
                'user_id' => auth()->id(),
                'pengajuan_id' => $this->data->id,
            ])->first();

            if ($this->status_dokumen == "2") { // Need Correction
                $uploadedFile = $this->data->uploadFile($this->file_koreksi, 'upload_correction_verifikator', "koreksi_{$this->dok_name}_{$this->data->nomor_registrasi_simbg}");
                if (!$uploadedFile) {
                    DB::rollBack(); // Rollback jika gagal upload file
                    return $this->alertMessage('error', 'GAGAL MENGUPLOAD FILE!', 'Server Tidak Merespon File Yang Kamu Upload, Silahkan di Upload lagi!');
                }
                $msg = "*Informasi Aplikasi Percepatan SIMBG*\n"
                . "Yth. {$this->data->user->name}.\n\n"
                . "Dokumen {$this->ldok->type_dokumen->nama_dokumen} Anda Perlu Diperbaiki*.\n\n"
                . "📄 Silakan Lihat Dokumen Yang telah kami lampirkan , Harap Diperbaiki Dalam Waktu 1 - 3 Hari Jika Tidak Pengajuan akan dibatalkan*\n"
                . "Untuk Informasi Lebih Lanjut,Silahkan Kunjungi Link Berikut :" . route('pengajuan.detail.upload', ['dokId' => $this->type_dok, 'id' => encrypt($this->data->id)]) . ".\n\n"
                    . "Terima kasih atas perhatian dan kerja sama Anda.\n"
                    . "-------------------------------------\n"
                    . "_Pesan ini bersifat rahasia dan dikirim secara otomatis oleh sistem bot._\n"
                    . "_Mohon untuk tidak membalas pesan ini._";
                Auth::user()->sendMessageWA($this->data->no_wa, $msg, $this->data->getFirstMedia('upload_correction_verifikator')->getPath());
                $vp->status_verifikator = '2';
                $vp->save();
            }
            if ($this->status_dokumen == "3") {
                // check semua dokumen telah diverifikasi
                $CheckDokAllComplete = DokumenPemohon::all()->map(function ($d) {
                    $hasDokComplete = HistoryUploadDokumenPemohon::where('user_id', $this->data->user_id)
                        ->where('dokumen_type_id', $d->id)
                        ->latest()
                        ->first()
                        ->status;
                    return $hasDokComplete == '3';
                });
                // If all documents are complete, send a message
                if ($CheckDokAllComplete->every(function ($complete) {return $complete;})) {
                    $this->data->status = '2';
                    $this->data->save();
                    $msg = "*Informasi Aplikasi Manajemen Bangunan Gedung (AMANBANG)*\n"
                        . "Yth. {$this->data->user->name}.\n\n"
                        . "Semua Dokumen Anda Telah Berhasil Melewati Verifikasi Tim Ahli*.\n"
                        . "Silahkan Upload Berkas-Berkas Anda Kembali yg telah ter-verifikasi Tim Ahli ke *https://simbg.pu.go.id/*\n"
                        . "Anda Bisa Mendownload Berkas Anda Di :\nhttps://amanbang.pekanbaru.go.id/dashboard\n\n"
                        . "Terima kasih atas perhatian dan kerja sama Anda.\n"
                        . "-------------------------------------\n"
                        . "_Pesan ini bersifat rahasia dan dikirim secara otomatis oleh sistem bot._\n"
                        . "_Mohon untuk tidak membalas pesan ini._";
                    Auth::User()->sendMessageWA($this->data->no_wa, $msg);
                }
                $vp->status_verifikator = '3';
                $vp->save();
            }
            $this->sendNotification($this->data->user_id, $this->data->id, 'Verifikator Checked Your ' . $this->ldok->type_dokumen->nama_dokumen, 'Dokumen Kamu Telah Diperiksa, Silahkan lihat informasi Lebih Lanjut', '', 'user');
            $successMessage = 'Berhasil Memberikan Catatan, Catatan Akan Diteruskan ke pemohon';
            session()->flash('alert', $successMessage);
            DB::commit(); // Menyimpan semua perubahan dalam database
            $this->alertMessageSuccess($successMessage);
            // $this->redirectRoute('verifikator.detail.upload.tpt', ['id' => encrypt($this->data->id)]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Menggulirkan transaksi jika terjadi kesalahan
            $errorMessage = '[' . $th->getCode() . '] ' . 'Terjadi kesalahan saat Menyimpan Data, Please Contact Admin & Send Screenshoot Error.';
            session()->flash('error', 'Terjadi kesalahan saat ' . $errorMessage . ' data.');
            $this->alertMessage('error', $errorMessage, $th->getMessage());
        }
    }
    protected function rules()
    {
        $rules = [
            'status_dokumen' => 'required',
        ];

        foreach ($this->JenisKeteranganDokumen() as $v) {
            if ($this->status_dokumen == 2 && !$this->input_keterangan_sesuai[$v->kode]) {
                $rules["input_catatan_gambar.{$v->kode}"] = 'required';
            } elseif ($this->status_dokumen == 3 && !$this->input_keterangan_sesuai[$v->kode]) {
                $rules["input_keterangan_sesuai.{$v->kode}"] = 'required|in:1,true';
            }
        }

        if ($this->status_dokumen == '2') {
            $rules['file_koreksi'] = [
                'required',
                'file',
                'mimes:png,jpg,pdf',
                'max:2048', // ukuran dalam kilobyte, 2048 = 2 MB
            ];
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [];

        foreach ($this->JenisKeteranganDokumen() as $v) {
            if ($this->status_dokumen == 2 && !$this->input_keterangan_sesuai[$v->kode]) {
                $messages["input_catatan_gambar.{$v->kode}.required"] = "Catatan Kesalahan Tentang {$v->persyaratan} Harus Diisi Sebelum memberikan Status Need-Correction";
            } elseif ($this->status_dokumen == 3 && !$this->input_keterangan_sesuai[$v->kode]) {
                $messages["input_keterangan_sesuai.{$v->kode}.required"] = "Ubah Switch Ke Sudah Terlebih Dahulu sebelum Memberikan status Selesai Pada Dokumen ini";
                $messages["input_keterangan_sesuai.{$v->kode}.in"] = "Ubah Switch Ke Sudah Terlebih Dahulu sebelum Memberikan status Selesai Pada Dokumen ini";
            }
        }

        return $messages;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    private function sendNotification($user, $pengajuanId, $title, $keterangan, $url, $type)
    {
        $notif = Notification::create([
            'user_id' => $user,
            'pengajuan_id' => $pengajuanId,
            'title' => $title,
            'keterangan' => $keterangan,
            'url' => $url,
            'type' => $type,
        ]);
    }
}
