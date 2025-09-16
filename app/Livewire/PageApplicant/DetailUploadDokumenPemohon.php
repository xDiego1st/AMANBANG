<?php

namespace App\Livewire\PageApplicant;

use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Models\JenisKeteranganPemohon;
use App\Models\KeteranganDetailUploadPemohon;
use App\Models\Notification;
use App\Models\VerifikatorHasPengajuan;
use App\Traits\WithModelValue;
use App\Traits\WithSweetAlert;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailUploadDokumenPemohon extends Component
{
    use WithFileUploads;
    use WithSweetAlert;
    use WithModelValue;
    public $data;
    public $reuploadfile;

    #[Locked]
    public $dp, $dokumen_type_id;

    //For Verifiaktor
    public $details_keterangan;
    public $input_keterangan_sesuai = [], $input_catatan_gambar = [];
    public $list_select_verifikator = ['On-Checking', 'Need-Correction', 'Complete'];
    public $status_dokumen;
    public $uniqueId;
    // Define the rules property
    public $rules = [];
    public $messages = [];
    public $file_koreksi;
    public $dok_name;
    public function mount($dokId, $id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            abort(403);
        }
        $this->uniqueId = str::random(8);
        $this->dp = DetailPemohon::with('user')->findOrFail($id);
        $this->dokumen_type_id = $dokId;
        $this->dok_name = $this->getCollectionNameDokId($dokId);
        $this->data = $this->dp->LatestDokumenUser($dokId); //history
        $this->setInputDefault();
        // $this->ensureVerifikatorAccess();
    }
    #[Computed]
    public function getCollectionNameDokId($dokId)
    {
        return DokumenPemohon::find($dokId)?->nama_file;
    }

    public function setInputDefault()
    {
        $this->details_keterangan = $this->data?->keterangan;
        foreach ($this->JenisKeteranganDokumen() as $key => $v) {
            $dk = KeteranganDetailUploadPemohon::where('dokumen_upload_id', $this->data->id)->where('jenis_keterangan', $v->id)->first();
            if ($dk != null) {
                $this->input_keterangan_sesuai[$v->kode] = $dk->kesesuaian;
                $this->input_catatan_gambar[$v->kode] = $dk->catatan;
            } else {
                $this->input_keterangan_sesuai[$v->kode] = null;
                $this->input_catatan_gambar[$v->kode] = null;
            }
        }
    }
    private function ensureVerifikatorAccess()
    {
        //Kondisi Jika Verifikator lain mengakses SLF
        $user = auth()->user();
        $vp = VerifikatorHasPengajuan::where('user_id', $user->id);
        if ($this->dp->id) {
            return abort(401, "Anda Tidak Diizinkan Untuk Memverifikasi Berkas Dokumen Ini!");
        }
    }
    public function saveCatatanDokumen()
    {
        $this->validate();

        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan Catatan Yang Diberikan Secara Keseluruhan?', 'Dokumen Akan diteruskan ke pemohon dengan status : ' . config('styles.status_upload.' . $this->status_dokumen . '.text'), 'handle_saveCatatanDokumen',
            []);
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

    #[On('handle_saveCatatanDokumen')]
    public function h_svd()
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {

            $this->data->status = $this->status_dokumen;
            $this->data->keterangan = $this->details_keterangan ?? null;
            $this->data->verified_by_user_id = auth()->user()->id;
            $this->data->verified_at = now();
            $this->data->save();

            foreach ($this->JenisKeteranganDokumen() as $key => $v) {
                $save = KeteranganDetailUploadPemohon::updateOrCreate(
                    [
                        'dokumen_upload_id' => $this->data->id,
                        'jenis_keterangan' => $v->id,
                    ], [
                        'catatan' => $this->input_catatan_gambar[$v->kode] ?? null,
                        'kesesuaian' => $this->input_keterangan_sesuai[$v->kode] ?? false,
                        'checked_by_user_id' => auth()->user()->id,
                    ]);
            }

            $vp = VerifikatorHasPengajuan::where([
                'user_id' => auth()->id(),
                'pengajuan_id' => $this->dp->id,
            ])->first();

            if ($this->data->status == "2") { // Need Correction
                $uploadedFile = $this->data->uploadFile($this->file_koreksi, 'upload_correction_verifikator', "koreksi_{$this->dok_name}_{$this->dp->nomor_registrasi_simbg}");
                if (!$uploadedFile) {
                    DB::rollBack(); // Rollback jika gagal upload file
                    return $this->alertMessage('error', 'GAGAL MENGUPLOAD FILE!', 'Server Tidak Merespon File Yang Kamu Upload, Silahkan di Upload lagi!');
                }
                // $msg = "*Informasi Aplikasi Percepatan SIMBG*\n"
                // . "Yth. {$this->data->user->name}.\n\n"
                // . "Dokumen {$this->data->type_dokumen->nama_dokumen} Anda Perlu Diperbaiki*.\n\n"
                // . "📄 Silakan Lihat Dokumen Yang telah kami lampirkan , Harap Diperbaiki Dalam Waktu 1 - 3 Hari Jika Tidak Pengajuan akan dibatalkan*\n"
                // . "Untuk Informasi Lebih Lanjut,Silahkan Kunjungi Link Berikut :" . route('pengajuan.detail.upload', ['dokId' => $this->dokumen_type_id, 'id' => $this->dp->id]) . ".\n\n"
                //     . "Terima kasih atas perhatian dan kerja sama Anda.\n"
                //     . "-------------------------------------\n"
                //     . "_Pesan ini bersifat rahasia dan dikirim secara otomatis oleh sistem bot._\n"
                //     . "_Mohon untuk tidak membalas pesan ini._";
                // Auth::user()->sendMessageWA($this->dp->no_wa, $msg, $this->data->getFirstMedia('upload_correction_verifikator')->getPath());
                $vp->status_verifikator = '2';
                $vp->save();
            }
            if ($this->data->status == "3") {
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
                    $detail_pemohon = DetailPemohon::where('user_id', $this->data->user_id)->first();
                    $detail_pemohon->status = '2';
                    $detail_pemohon->save();
                    $msg = "*Informasi Aplikasi Manajemen Bangunan Gedung (AMANBANG)*\n"
                        . "Yth. {$this->dp->user->name}.\n\n"
                        . "Semua Dokumen Anda Telah Berhasil Melewati Verifikasi Tim Ahli*.\n"
                        . "Silahkan Upload Berkas-Berkas Anda Kembali yg telah ter-verifikasi Tim Ahli ke *https://simbg.pu.go.id/*\n"
                        . "Anda Bisa Mendownload Berkas Anda Di :\nhttps://amanbang.pekanbaru.go.id/dashboard\n\n"
                        . "Terima kasih atas perhatian dan kerja sama Anda.\n"
                        . "-------------------------------------\n"
                        . "_Pesan ini bersifat rahasia dan dikirim secara otomatis oleh sistem bot._\n"
                        . "_Mohon untuk tidak membalas pesan ini._";
                    Auth::User()->sendMessageWA($this->dp->no_wa, $msg);
                }
                $vp->status_verifikator = '3';
                $vp->save();
            }
            $this->sendNotification($this->data->user_id, $this->dp->id, 'Verifikator Checked Your ' . $this->data->type_dokumen->nama_dokumen, 'Dokumen Kamu Telah Diperiksa, Silahkan lihat informasi Lebih Lanjut', '', 'user');
            $successMessage = 'Berhasil Memberikan Catatan, Catatan Akan Diteruskan ke pemohon';
            session()->flash('alert', $successMessage);
            DB::commit(); // Menyimpan semua perubahan dalam database
            $this->redirectRoute('pengajuan.detail.upload', ['dokId' => $this->dokumen_type_id, 'id' => encrypt($this->dp->id)]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Menggulirkan transaksi jika terjadi kesalahan
            $errorMessage = '[' . $th->getCode() . '] ' . 'Terjadi kesalahan saat Menyimpan Data, Please Contact Admin & Send Screenshoot Error.';
            session()->flash('error', 'Terjadi kesalahan saat ' . $errorMessage . ' data.');
            $this->alertMessage('error', $errorMessage, $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.page-applicant.detail-upload-dokumen-pemohon')->layout('layouts.base')->layoutData(
            [
                'title' => 'APLIKASI MANAJEMEN BANGUNAN GEDUNG',
            ]);
    }
    #[Computed()]
    public function JenisKeteranganDokumen()
    {
        return JenisKeteranganPemohon::where('dokumen_type_id', $this->dokumen_type_id)->get();
    }
    #[Computed()]
    public function GetKeteranganDokumen($id)
    {
        $data_keterangan = KeteranganDetailUploadPemohon::where('dokumen_upload_id', $this->data->id)->where('jenis_keterangan', $id)->latest()->first();
        return $data_keterangan;
    }
    #[Computed()]
    public function GetDetailKeteranganDokumenSebelumnya($id)
    {
        // Ambil semua ID dokumen yang sesuai
        $s_id = HistoryUploadDokumenPemohon::where('user_id', $this->data->user_id)
            ->where('dokumen_type_id', $this->data->dokumen_type_id)
            ->pluck('id');

        // Ambil semua data keterangan berdasarkan ID dokumen yang ditemukan
        $data_keterangan = KeteranganDetailUploadPemohon::whereIn('dokumen_upload_id', $s_id)
            ->where('jenis_keterangan', $id)
            ->latest()
            ->get();

        // Periksa apakah data terbaru adalah data saat ini
        if ($data_keterangan->first() && $data_keterangan->first()->dokumen_upload_id == $this->data->id) {
            // Ambil data kedua terbaru
            return $data_keterangan->skip(1)->first();
        } else {
            // Ambil data terbaru
            return $data_keterangan->first();
        }
    }

    #[Computed()]
    public function GetKeteranganDokumenSebelumnya()
    {
        // Ambil semua dokumen yang sesuai, diurutkan dari yang terbaru
        $dok_user = HistoryUploadDokumenPemohon::where('user_id', $this->data->user_id)
            ->where('dokumen_type_id', $this->data->dokumen_type_id)
            ->latest()
            ->get();

        // Periksa apakah ada dokumen yang ditemukan
        if ($dok_user->isEmpty()) {
            return null;
        }

        // Jika dokumen terbaru adalah dokumen saat ini, ambil dokumen kedua terbaru
        if ($dok_user->first()->id == $this->data->id) {
            return $dok_user->skip(1)->first();
        } else {
            // Ambil dokumen terbaru
            return $dok_user->first();
        }
    }
    #[Computed]
    public function jumlahUploadDokumenUser($user)
    {
        return HistoryUploadDokumenPemohon::where('user_id', $user)->where('dokumen_type_id', $this->data->dokumen_type_id)->count();
    }
    #[On('confirmAction')]
    public function confirmAction($data)
    {
        if ($data['do'] == "Approve") {
            $this->approve($data['id']);
        } else if ($data['do'] == "Reject") {
            $this->reject($data['id']);
        }
    }
    private function approve($id)
    {
        try {
            $data = HistoryUploadDokumenPemohon::findOrFail($id);
            $data->status = '1';
            $data->save();
            $this->alertMessageSuccess('Berhasil Melakukan Approve Data #' . $data->name);
            $this->dispatch('refreshComponent')->self();

        } catch (\Throwable $th) {
            $this->alertMessageError($th->getMessage());
        }

    }
    private function reject($id)
    {
        try {
            $data = HistoryUploadDokumenPemohon::findOrFail($id);
            $data->status = '4';
            $data->save();
            $this->alertMessageSuccess('Dokumen Telah Diterukan kepada pemohon Untuk di koreksi kembali' . $data->name);
            $this->dispatch('refreshComponent')->self();
        } catch (\Throwable $th) {
            $this->alertMessageError($th->getMessage());
        }
    }
    public function checkAll()
    {
        foreach ($this->JenisKeteranganDokumen() as $key => $v) {
            $dk = KeteranganDetailUploadPemohon::where('dokumen_upload_id', $this->data->id)->where('jenis_keterangan', $v->id)->first();
            $this->input_keterangan_sesuai[$v->kode] = true;
        }
    }
    public function submit_reupload()
    {
        $this->validate([
            'reuploadfile' => ['required', 'mimes:pdf', 'max:10000'],
        ]);
        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan Dokumen Arsitektur Yang Diberikan?', 'Dokumen Yang Telah Disubmit Akan diteruskan kepada Tim Ahli yang terkait untuk proses pemeriksaan dan tidak dapat diubah kembali sampai Tim Ahli terkait selesai memeriksa berkas anda', 'confirmedReupload',
            []);
    }
    #[On('confirmedReupload')]
    public function confirmedReupload()
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            $dok = HistoryUploadDokumenPemohon::Create([
                'user_id' => Auth()->user()->id,
                'pengajuan_id' => $this->dp->id,
                'dokumen_type_id' => $this->data->dokumen_type_id,
            ]);
            $vpdok = $this->dp->verifikatorTPAByDok($this->data->dokumen_type_id)->with('user')->first();
            $vpdok->status_verifikator = '1';
            $vpdok->save();
            $nama_file_prefix = $this->data->type_dokumen->nama_file;
            $uploadedFile = $dok->uploadFile($this->reuploadfile, $nama_file_prefix, $nama_file_prefix);
            if (!$uploadedFile) {
                DB::rollBack();
                return $this->alertMessage('error', 'GAGAL MENGUPLOAD FILE!', 'Server Tidak Merespon File Yang Kamu Upload, Silahkan di Upload lagi!');
            } else {
                $this->dispatch('clearFileInputs');
            }
            $url = route('pengajuan.detail.upload', ['dokId' => $this->dokumen_type_id, 'id' => encrypt($this->dp->id)]);
            $msg = "*Informasi Aplikasi Manajemen Bangunan Gedung (AMANBANG)*\n"
                . "Yth. {$vpdok->user->name}.\n\n"
                . "{$dok->type_dokumen->nama_dokumen} Atas Nama *{$dok->user->name}*.\n"
                . "Telah Memberikan Dokumen Baru Atas Koreksi yang telah anda sampaikan"
                . "📄 Silakan Lihat dokumen Baru Tersebut melalui link berikut di: \n"
                . $url
                . "\n"
                . "Terima kasih atas perhatian dan kerja sama Anda.\n"
                . "-------------------------------------\n"
                . "_Pesan ini bersifat rahasia dan dikirim secara otomatis oleh sistem bot._\n"
                . "_Mohon untuk tidak membalas pesan ini._";
            Auth::User()->sendMessageWA($vpdok->user->no_wa, $msg);
            $this->sendNotification($this->dp->user->id, $this->dp->id, 'Re-Submitted ' . $dok->type_dokumen->nama_dokumen, 'Dokumen Diteruskan ke TPA/TPT untuk pemeriksaan', $url, 'user');
            $successMessage = 'Berkas Berhasil Diteruskan, Mohon Menunggu Tim Ahli Terkait memeriksa Berkas Anda';
            session()->flash('alert', $successMessage);
            DB::commit(); // Menyimpan semua perubahan dalam database
            $this->redirectRoute('pengajuan.detail.upload', ['dokId' => $this->dokumen_type_id, 'id' => encrypt($this->dp->id)]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Menggulirkan transaksi jika terjadi kesalahan
            $errorMessage = '[' . $th->getCode() . '] ' . 'Terjadi kesalahan saat Meneruskan Berkas, Please Contact Admin & Send Screenshoot Error.';
            session()->flash('error', 'Terjadi kesalahan saat ' . $errorMessage . ' data.');
            $this->alertMessage('error', $errorMessage, $th->getMessage());
        }
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
    #[Computed]
    public function loadDokumen()
    {
        $dok = DokumenPemohon::all();
        return $dok;
    }
}
