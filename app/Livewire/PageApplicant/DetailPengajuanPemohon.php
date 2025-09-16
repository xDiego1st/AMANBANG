<?php

namespace App\Livewire\PageApplicant;

use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Models\Notification;
use App\Traits\WithCustomTraits;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class DetailPengajuanPemohon extends Component
{
    use WithFilePond;
    use WithCustomTraits;
    public $file_arsitektur, $file_struktur, $file_mep;
    public $files_upload = [];

    public $nomor_registrasi_simbg;

    #[Locked]
    public $ids;
    public $data;
    public function mount($id)
    {
        $this->files_upload['upload_arsitektur'] = null;

        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return abort(404);
        };
        $this->ids = $decrypted;
        $this->data = DetailPemohon::find($decrypted);
    }
    public function render()
    {
        return view('livewire.page-applicant.detail-pengajuan-pemohon')->layout('layouts.base')->layoutData(
            [
                'title' => 'Aplikasi Manajemen Bangunan Gedung',
            ]);
    }
    #[Computed]
    public function loadDokumen()
    {
        $dok = DokumenPemohon::all();
        return $dok;
    }
    #[Computed]
    public function loadNotification()
    {
        return Notification::where('user_id', auth()->user()->id)->latest()->get()->take(3);
    }
    #[Computed]
    public function loadStatusDokumen($dokumen_type_id)
    {
        $status = HistoryUploadDokumenPemohon::where('dokumen_type_id', $dokumen_type_id)
            ->where('user_id', auth()->user()->id)
            ->where('pengajuan_id', $this->ids)
            ->latest()->first();
        return $status ?? null;
    }
    public function countStatusDokumen()
    {
        $count = 0;
        $dok = $this->loadDokumen();
        foreach ($dok as $key => $value) {
            $doktb = $this->loadStatusDokumen($value->id);
            if ($doktb) {
                if ($doktb->status == '2') {
                    $count++;
                }
            } else {
                $count++;
            }

        }
        return $count;
    }
    public function submitDokumen($dok)
    {
        $data = json_decode($dok, true);
        $this->validate([
            "files_upload." . $data['nama_file'] => ['required', 'mimes:pdf', 'max:10000'],
        ]);
        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan ' . $data['nama_dokumen'] . ' Yang Diberikan?', 'Dokumen Yang Telah Disubmit Akan diteruskan kepada Tim Ahli yang terkait untuk proses pemeriksaan dan tidak dapat diubah kembali sampai Tim Ahli terkait selesai memeriksa berkas anda', 'confirmedUploadDocument',
            $data);
    }
    #[On('confirmedUploadDocument')]
    public function confirmedUploadDocument($data)
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            $dok = HistoryUploadDokumenPemohon::Create([
                'user_id' => Auth()->user()->id,
                'pengajuan_id' => $this->ids,
                'dokumen_type_id' => $data['id'],
            ]);
            $nama_file = $data['nama_file'];
            $uploadedFile = $dok->uploadFile($this->files_upload[$nama_file], $nama_file, $nama_file);
            if (!$uploadedFile) {
                DB::rollBack();
                return $this->alertMessage('error', 'GAGAL MENGUPLOAD FILE!', 'Server Tidak Merespon File Yang Kamu Upload, Silahkan di Upload lagi!');
            } else {
                $this->dispatch('clearFileInputs');
            }
            DB::commit(); // Menyimpan semua perubahan dalam database
            $this->sendNotification('Submitted ' . $dok->type_dokumen->nama_dokumen, 'Dokumen Diteruskan ke TPA/TPT untuk pemeriksaan', '', 'user');
            $successMessage = 'Berkas Berhasil Diteruskan, Mohon Menunggu Tim Ahli Terkait memeriksa Berkas Anda';
            session()->flash('alert', $successMessage);
            $this->redirectRoute('pemohon.pengajuan.dashboard.upload', [$id = encrypt($this->ids)]);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Menggulirkan transaksi jika terjadi kesalahan
            $errorMessage = '[' . $th->getCode() . '] ' . 'Terjadi kesalahan saat Meneruskan Berkas, Please Contact Admin & Send Screenshoot Error.';
            session()->flash('error', 'Terjadi kesalahan saat ' . $errorMessage . ' data.');
            $this->alertMessage('error', $errorMessage, $th->getMessage());
        }
    }
    public function submitDokumenArsitektur()
    {
        $this->validate([
            'file_arsitektur' => ['required', 'mimes:pdf', 'max:10000'],
        ]);
        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan Dokumen Arsitektur Yang Diberikan?', 'Dokumen Yang Telah Disubmit Akan diteruskan kepada Tim Ahli yang terkait untuk proses pemeriksaan dan tidak dapat diubah kembali sampai Tim Ahli terkait selesai memeriksa berkas anda', 'confirmedArsitektur',
            []);
    }
    public function submitDokumenStuktur()
    {
        $this->validate([
            'file_struktur' => ['required', 'mimes:pdf', 'max:10000'],
        ]);
        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan Dokumen Stuktur Yang Diberikan?', 'Dokumen Yang Telah Disubmit Akan diteruskan kepada Tim Ahli yang terkait untuk proses pemeriksaan dan tidak dapat diubah kembali sampai Tim Ahli terkait selesai memeriksa berkas anda', 'confirmedStuktur',
            []);
    }

    public function submitDokumenMep()
    {
        $this->validate([
            'file_mep' => ['required', 'mimes:pdf', 'max:10000'],
        ]);
        $this->alertEvent('warning', 'Apa Kamu Yakin Dengan Dokumen MEP Yang Diberikan?', 'Dokumen Yang Telah Disubmit Akan diteruskan kepada Tim Ahli yang terkait untuk proses pemeriksaan dan tidak dapat diubah kembali sampai Tim Ahli terkait selesai memeriksa berkas anda', 'confirmedMEP',
            []);
    }
    public function RiwayatDokumenUploadPemohon($typeDokumen)
    {
        return HistoryUploadDokumenPemohon::where([
            'user_id' => auth()->user()->id,
            'dokumen_type_id' => $typeDokumen,
            'pengajuan_id' => $this->ids,
        ])->count();
    }
    private function sendNotification($title, $keterangan, $url, $type)
    {
        $notif = Notification::create([
            'user_id' => auth()->user()->id,
            'title' => $title,
            'keterangan' => $keterangan,
            'url' => $url,
            'type' => $type,
        ]);
    }
    public function saveNomorRegistrasiSimbg()
    {
        $this->validate([
            'nomor_registrasi_simbg' => ['required', 'regex:/^[A-Z]{3}-\d{6}-\d{8}-\d{2}$/'],
        ], [
            'nomor_registrasi_simbg.regex' => 'Format input tidak valid. Pastikan formatnya adalah Tiga huruf kapital diikuti dengan enam digit angka, delapan digit angka, dan dua digit angka, dengan tanda hubung sebagai pemisah. Example : PBG-147111-30102023-01 |
            SLF-147111-30102023-01',
        ]);
        $this->alertEvent('warning', 'Apakah Nomor Registrasi Sudah Benar?', 'Nomor Registrasi Tidak Dapat Diubah Kembali! Mohon Input Dengan Benar', 'confirmedNomorRegistrasiSimbg',
            []);

    }

    #[On('confirmedNomorRegistrasiSimbg')]
    public function submitnomorregis()
    {
        $dp = DetailPemohon::where('id', $this->ids)->first();
        $dp->nomor_registrasi_simbg = $this->nomor_registrasi_simbg;
        $dp->save();
        $successMessage = 'Nomor Registrasi Disimpan';
        session()->flash('alert', $successMessage);
        $this->redirectRoute('pemohon.pengajuan.dashboard.upload', [$id = encrypt($this->ids)]);
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

    public function downloadBA($id)
    {
        $this->dispatch('open-tab', url: route('genarate.pdf.ba', ['idpengajuan' => $id]));
    }
    public function downloadMedia($id, $collectionName)
    {
        try {
            $id = decrypt($id); // akan throw jika dimodif user
        } catch (DecryptException $e) {
            abort(403, 'Payload tidak valid.');
        }
        $dp = DetailPemohon::findOrFail($id);

        // cek apakah ada media di koleksi ini
        if (!$dp->hasMedia($collectionName)) {
            abort(404, 'File tidak ditemukan.');
        }

        // ambil media pertama dari koleksi
        $media = $dp->getFirstMedia($collectionName);
        $filePath = $media->getPath();
        $fileName = "[".now()."] ".$collectionName . "_" . $dp->nama_bangunan; // nama asli yg disimpan

        return response()->streamDownload(function () use ($filePath) {
            readfile($filePath);
        }, $fileName, [
            'Content-Type' => $media->mime_type ?? 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }

}
