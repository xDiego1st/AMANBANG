<?php

namespace App\Livewire\PageApplicant;

use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Models\Notification;
use App\Traits\WithCustomTraits;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class DashboardApplicant extends Component
{
    use WithFilePond;
    use WithCustomTraits;
    public $file_arsitektur, $file_struktur, $file_mep;
    public $files_upload = [];

    public $nomor_registrasi_simbg;

    public function mount()
    {
        // if (auth()->user()->status_account == 0) {
        //     return redirect()->route('pemohon.FormPageDataPemohon');
        // } else {
        //     $this->nomor_registrasi_simbg = $this->loadDetailPemohon()?->nomor_registrasi_simbg;
        // }
    }
    public function render()
    {
        return view('livewire.page-applicant.dashboard-applicant')->layout('layouts.base')->layoutData(
            [
                'title' => 'SISTEM PERCEPATAN SIMBG',
            ]);
    }
    #[Computed]
    public function loadDokumen()
    {
        return DokumenPemohon::all();
    }
    #[Computed]
    public function loadDetailPemohon()
    {
        return DetailPemohon::where('user_id', auth()->user()->id)->first();
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
            ->latest()->first();
        return $status;
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
            $this->redirectRoute('pemohon.dashboard');
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
    #[On('confirmedArsitektur')]
    public function handleConfirmationArsitektur()
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            $dok = HistoryUploadDokumenPemohon::Create([
                'user_id' => Auth()->user()->id,
                'dokumen_type_id' => '1',
            ]);
            $uploadedFile = $dok->uploadFile($this->file_arsitektur, 'upload_arsitektur', 'dok_arsitektur');
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
            $this->redirectRoute('pemohon.dashboard');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Menggulirkan transaksi jika terjadi kesalahan
            $errorMessage = '[' . $th->getCode() . '] ' . 'Terjadi kesalahan saat Meneruskan Berkas, Please Contact Admin & Send Screenshoot Error.';
            session()->flash('error', 'Terjadi kesalahan saat ' . $errorMessage . ' data.');
            $this->alertMessage('error', $errorMessage, $th->getMessage());
        }
    }
    #[On('confirmedStuktur')]
    public function handleConfirmationStuktur()
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            $dok = HistoryUploadDokumenPemohon::Create([
                'user_id' => Auth()->user()->id,
                'dokumen_type_id' => '2',
            ]);
            $uploadedFile = $dok->uploadFile($this->file_struktur, 'upload_stuktur', 'dok_stuktur');
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
            $this->redirectRoute('pemohon.dashboard');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Menggulirkan transaksi jika terjadi kesalahan
            $errorMessage = '[' . $th->getCode() . '] ' . 'Terjadi kesalahan saat Meneruskan Berkas, Please Contact Admin & Send Screenshoot Error.';
            session()->flash('error', 'Terjadi kesalahan saat ' . $errorMessage . ' data.');
            $this->alertMessage('error', $errorMessage, $th->getMessage());
        }
    }
    #[On('confirmedMEP')]
    public function handleConfirmationMEP()
    {
        DB::beginTransaction(); // Memulai transaksi database
        try {
            $dok = HistoryUploadDokumenPemohon::Create([
                'user_id' => Auth()->user()->id,
                'dokumen_type_id' => '3',
            ]);
            $uploadedFile = $dok->uploadFile($this->file_mep, 'upload_mep', 'dok_mep');
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
            $this->redirectRoute('pemohon.dashboard');
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Menggulirkan transaksi jika terjadi kesalahan
            $errorMessage = '[' . $th->getCode() . '] ' . 'Terjadi kesalahan saat Meneruskan Berkas, Please Contact Admin & Send Screenshoot Error.';
            session()->flash('error', 'Terjadi kesalahan saat ' . $errorMessage . ' data.');
            $this->alertMessage('error', $errorMessage, $th->getMessage());
        }
    }
    public function RiwayatDokumenUploadPemohon($typeDokumen)
    {
        return HistoryUploadDokumenPemohon::where('user_id', auth()->user()->id)->where('dokumen_type_id', $typeDokumen)->count();
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
        $dp = DetailPemohon::where('user_id', auth()->user()->id)->first();
        $dp->nomor_registrasi_simbg = $this->nomor_registrasi_simbg;
        $dp->save();
        $successMessage = 'Nomor Registrasi Disimpan';
        session()->flash('alert', $successMessage);
        $this->redirectRoute('pemohon.dashboard');
    }

    public function downloadBA()
    {
        $this->dispatch('open-tab', url: route('genarate.pdf.ba', ['userid' => auth()->user()->id]));
    }
    public function DownloadKRK()
    {
        $filePath = public_path('images/TemplateForm/KRK Example.pdf');
        $fileName = 'KRK.pdf';

        return response()->streamDownload(function () use ($filePath) {
            readfile($filePath);
        }, $fileName, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }
}
