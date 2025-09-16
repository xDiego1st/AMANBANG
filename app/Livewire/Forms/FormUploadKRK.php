<?php

namespace App\Livewire\Forms;

use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Models\User;
use App\Models\VerifikatorHasPengajuan;
use App\Traits\WithCustomTraits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class FormUploadKRK extends Component
{
    //---------------------
    use WithFilePond;
    use WithCustomTraits;
    #[Locked]
    public $ids;
    public $uniqueId;
    public $data;
    //---------------------

    //Form Data
    public $nomor_registrasi_simbg;
    public $files_upload_krk;
    public $selected_tim_ahli = [];
    public $selected_pengawas = [];
    public $upload_arsitektur;
    public $upload_struktur;
    public $upload_mep;

    public function mount($ids)
    {
        $this->data = DetailPemohon::find($ids);
    }
    public function render()
    {
        return view('livewire.forms.form-upload-k-r-k');
    }

    public function submit()
    {
        $this->validate();
        /** @var \App\Models\User $user */
        $user = Auth::user();
        DB::beginTransaction(); // Memulai transaksi database
        try {
            if ($this->data->status == '1') {
                $this->data->nomor_registrasi_simbg = $this->nomor_registrasi_simbg;
                $allUsers = array_merge($this->selected_tim_ahli, $this->selected_pengawas);
                foreach ($allUsers as $userId) {
                    // cek apakah user ini pengawas
                    $isPengawas = in_array($userId, $this->selected_pengawas, true);
                    if ($isPengawas) {
                        VerifikatorHasPengajuan::updateOrCreate(
                            [
                                'user_id' => $userId,
                                'pengajuan_id' => $this->data->id,
                            ],
                            [
                                'status_verifikator' => '3', // TANPA DOKUMEN PENGAWAS
                            ]);
                    } else {
                        VerifikatorHasPengajuan::updateOrCreate(
                            [
                                'user_id' => $userId,
                                'pengajuan_id' => $this->data->id,
                            ]);
                    }

                }
                //--------------------------------
                $user_yg_mengajukan = $this->data->user->id;

                $dok1 = HistoryUploadDokumenPemohon::create([
                    'user_id' => $user_yg_mengajukan,
                    'dokumen_type_id' => '1',
                    'pengajuan_id' => $this->data->id,
                ]);
                $r1 = $dok1->uploadFile($this->upload_arsitektur, 'upload_arsitektur', "arsitektur_{$this->nomor_registrasi_simbg}");
                if (!$r1['status']) {
                    throw new \RuntimeException($r1['message'] ?? 'Upload arsitektur gagal');
                }

                $dok2 = HistoryUploadDokumenPemohon::create([
                    'user_id' => $user_yg_mengajukan,
                    'dokumen_type_id' => '2',
                    'pengajuan_id' => $this->data->id,
                ]);
                $r2 = $dok2->uploadFile($this->upload_struktur, 'upload_struktur', "stuktur_{$this->nomor_registrasi_simbg}");
                if (!$r2['status']) {
                    throw new \RuntimeException($r2['message'] ?? 'Upload struktur gagal');
                }

                $dok3 = HistoryUploadDokumenPemohon::create([
                    'user_id' => $user_yg_mengajukan,
                    'dokumen_type_id' => '3',
                    'pengajuan_id' => $this->data->id,
                ]);
                $r3 = $dok3->uploadFile($this->upload_mep, 'upload_mep', "mep_{$this->nomor_registrasi_simbg}");
                if (!$r3['status']) {
                    throw new \RuntimeException($r3['message'] ?? 'Upload MEP gagal');
                }
//--------------------------------
                $noticetitle = 'Berhasil Mendaftarkan Penomoran Simbg dan Tim Ahli Pada Pengajuan ' . $this->data->nama;
                $noticedesc = 'Selanjutnya Pemohon diharapkan segera mengupload Dokumen Yang Diperlukan di sistem amanbang';

            } elseif ($this->data->status == '0') {
                // Upload file

                if ($this->data->jenis_pengajuan === "PBG") {
                    $uploadedFile = $this->data->uploadFile($this->files_upload_krk, 'krk', "krk_{$this->nomor_registrasi_simbg}");
                    if (!$uploadedFile) {
                        DB::rollBack(); // Rollback jika gagal upload file
                        return $this->alertMessage('error', 'GAGAL MENGUPLOAD FILE!', 'Server Tidak Merespon File Yang Kamu Upload, Silahkan di Upload lagi!');
                    }
                }

                $this->data->status = 1;
                $this->data->verified_operator_at = now();
                $msg = "*Informasi Aplikasi Manajemen Bangunan Gedung (AMANBANG)*\n"
                    . "Yth. {$this->data->user->name}.\n\n"
                    . "Dokumen KRK Anda telah *diterbitkan*.\n\n"
                    . "📄 Silakan unduh dokumen KRK Anda melalui tautan resmi di: *amanbang.pekanbaru.go.id*\n"
                    . "Atau gunakan dokumen yang telah kami lampirkan.\n\n"
                    . "⚠️ Jangan lupa melakukan permohonan PBG di *simbg.pekanbaru.go.id* "
                    . "agar nomor registrasi SIMBG Anda dapat tercatat dalam sistem amanbang.\n\n"
                    . "Terima kasih atas perhatian dan kerja sama Anda.\n"
                    . "-------------------------------------\n"
                    . "_Pesan ini bersifat rahasia dan dikirim secara otomatis oleh sistem bot._\n"
                    . "_Mohon untuk tidak membalas pesan ini._";
                $user->sendMessageWA($this->data->no_wa, $msg, $this->data->getFirstMedia('krk')->getPath());

                if ($this->data->jenis_pengajuan === "PBG") {
                    $noticetitle = 'Berhasil Menerbitkan KRK Atas Nama#' . $this->data->nama;
                    $noticedesc = 'Dokumen KRK Telah Diteruskan ke Pemohon. ~ Terimakasih';
                } else {
                    $noticetitle = 'Berhasil Memverifikasi Pengajuan SLF atas Nama#' . $this->data->nama;
                    $noticedesc = 'Pemberitahuan Telah Diteruskan Ke Pemohon. ~ Terimakasih';
                }

            }
            $this->data->save();
            DB::commit(); // Menyimpan semua perubahan dalam database
            $this->reset();
            $this->dispatch('close-modal', targetId: "modalsUploadKRKPemohon");
            $this->dispatch('reloadTable');
            $this->alertMessage('success', $noticetitle, $noticedesc, 3000);
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback jika terjadi kesalahan
            $this->alertMessage('error', 'GAGAL', $th->getMessage());
        }
    }

    public function getListUserByRole($role)
    {

        $user = null;
        if ($role == "VERIFIKATOR") {
            $tp = $this->data?->team_penilai_ba;
            $user = User::where('role', $role)->where('jenis_user', $tp)->get();
        } elseif ($role == "PENGAWAS") {
            $user = User::where('role', $role)->get();
        }
        return $user;
    }

    #[Computed]
    public function loadDokumen()
    {
        $dok = DokumenPemohon::all();
        return $dok;
    }
    protected function rules()
    {
        $rules = [];
        if ($this->data?->status == 1) {
            $rules['nomor_registrasi_simbg'] = ['required'];
            if ($this->data?->jenis_pengajuan === "PBG") {
                if ($this->data?->team_penilai_ba == "TPA") {
                    $rules['selected_tim_ahli'] = ['required', 'array', 'size:3'];
                    $rules['selected_pengawas'] = ['required', 'array', 'min:1', 'max:2'];
                    $rules['selected_pengawas.*'] = ['distinct'];
                } else {
                    //TPT WAJIB 2 PENGAWAS
                    $rules['selected_pengawas'] = ['required', 'array', 'size:2'];
                    $rules['selected_pengawas.*'] = ['distinct'];
                    $rules['selected_tim_ahli'] = ['required', 'array', 'size:1'];
                }
            } else {
                $rules['selected_tim_ahli'] = ['required', 'array', 'size:1'];
            }
        }
        if ($this->data?->jenis_pengajuan === "PBG" && $this->data?->status == '0') {
            $rules['files_upload_krk'] = ['required'];
        } else {
            $rules['files_upload_krk'] = ['nullable'];
            if ($this->data->jenis_pengajuan === "PBG") {
                foreach ($this->loadDokumen() as $key => $v) {
                    $rules[$v->nama_file] = [
                        'required',
                        'file',
                        'mimetypes:image/jpeg,image/png,application/pdf',
                        'max:2048', // ukuran maksimum 1 MB
                    ];
                }
            }
        }

        return $rules;
    }
    //-------------------

    public function disp($val): string
    {
        // Tampilkan placeholder jika null/kosong
        return filled($val) ? (string) $val : '-';
    }

    public function formatLuas($val): string
    {
        if (blank($val)) {
            return '-';
        }

        return number_format((float) $val, 0, ',', '.');
    }

    public function fmtDate($val): string
    {
        // Format tanggal rapi: 07 Sep 2025 14:35
        if (blank($val)) {
            return '-';
        }

        try {
            return \Carbon\Carbon::parse($val)->timezone('Asia/Jakarta')->isoFormat('DD MMM YYYY HH:mm');
        } catch (\Throwable $e) {
            return (string) $val;
        }
    }
    public function statusBadge($status): array
    {
        $map = [
            0 => ['KRK Diproses', 'bg-secondary'],
            1 => ['Menunggu Validasi', 'bg-warning text-dark'],
            2 => ['Menunggu Pengabsahan BA', 'bg-info text-dark'],
            3 => ['Selesai BA', 'bg-success'],
        ];
        return $map[$status] ?? ['Tidak Diketahui', 'bg-light text-dark'];
    }
    /** Progress sederhana berdasarkan status (opsional untuk progress bar) */
    public function statusProgress($status): int
    {
        return match ((int) $status) {
            0 => 15,
            1 => 45,
            2 => 75,
            3 => 100,
            default => 0
        };
    }
    public function mapsLink($koor): ?string
    {
        if (blank($koor)) {
            return null;
        }

        // Validasi sederhana lat,lng
        if (!preg_match('/^-?\d+(\.\d+)?\s*,\s*-?\d+(\.\d+)?$/', trim($koor))) {
            return null;
        }
        $q = urlencode(trim($koor));
        return "https://www.google.com/maps?q={$q}";
    }
}
