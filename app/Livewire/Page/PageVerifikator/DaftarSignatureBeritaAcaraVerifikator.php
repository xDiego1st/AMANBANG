<?php

namespace App\Livewire\Page\PageVerifikator;

use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Models\VerifikatorHasPengajuan;
use App\Traits\WithSweetAlert;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class DaftarSignatureBeritaAcaraVerifikator extends Component
{
    use WithSweetAlert;
    use WithPagination;

    // -- Preferensi: komentar dalam Bahasa Indonesia --
    public int $perPage = 6; // jumlah awal item per halaman
    protected $queryString = ['perPage']; // opsional: biar state perPage ikut di URL

    // Atur theme pagination agar cocok (optional)
    protected string $paginationTheme = 'bootstrap';

    // Reset halaman saat filter berubah (kalau nanti ada filter tambahan)
    public function updatingPerPage()
    {
        $this->resetPage();
    }

    // Tombol/trigger untuk load more
    public function loadMore(): void
    {
        // Tambah kuota item yang dirender
        $this->perPage += 6;
    }

    public function render()
    {
        $user = Auth()->user();
        if ($user->role == "ADMIN") {
            $subLatest = VerifikatorHasPengajuan::query()
                ->selectRaw('MAX(id) AS id')
                ->whereHas('pengajuan', fn($q) =>
                    $q->where('has_checked_ba', true)->where('status', '!=', '3')
                )
                ->groupBy('pengajuan_id');

            $data = VerifikatorHasPengajuan::with(['pengajuan', 'user', 'pengajuan.user'])
                ->whereIn('id', $subLatest) // id terbaru per pengajuan_id yang status != 3
                ->latest('id')
                ->paginate($this->perPage);
        } else {
            $data = VerifikatorHasPengajuan::with(['pengajuan', 'user', 'pengajuan.user'])
                ->where('user_id', Auth::id())
                ->where('status_verifikator', '=', 3)
                ->latest('id')
                ->paginate($this->perPage); // kunci: paginate pakai perPage dinamis
        }

        return view('livewire.page.page-verifikator.daftar-signature-berita-acara-verifikator', [
            'data' => $data,
        ])->layout('layouts.base')->layoutData([
            'title' => 'Daftar Signature Berita Acara Pemohon',
        ]);
    }
    public function konfirmasiBA(string $encryptedId)
    {
        if (auth()->user()->role == "ADMIN") {
            $title = 'Konfirmasi Pengabsahan Berita Acara';
        } else {
            $title = 'Konfirmasi Penandatangan Berita Acara';
        }
        $this->confirm(
            method: 'TTDBA',
            params: [
                ['id' => $encryptedId],
            ], // kalau perlu kirim parameter -> ['id' => 123, ...]
            swal: [
                'title' => $title,
                'text' => 'Data Berita Acara yang telah ditandatangani tidak dapat diubah, Harap Perhatikan Data Pengajuan secara hati-hati Sebelum Melakukan Penandatanganan Dokumen',
                'icon' => 'warning',
            ],
        );

    }

    public function TTDBA($data)
    {
        if (auth()->user()->role == "VERIFIKATOR" || auth()->user()->role == "PENGAWAS") {
            try {
                $id = decrypt($data['id']);
            } catch (DecryptException $e) {
                abort(403, 'Payload tidak valid.');
            }
            $pengajuan = VerifikatorHasPengajuan::where([
                'user_id' => auth()->id(),
                'pengajuan_id' => $id,
            ])->firstOrFail();
            $pengajuan->status_verifikator = 4;
            $pengajuan->save();
            // check semua dokumen telah diverifikasi
            $allComplete = !VerifikatorHasPengajuan::where('pengajuan_id', $id)
                ->where('status_verifikator', '!=', 4)
                ->exists();

            if ($allComplete) {
                $pengajuan->pengajuan->has_checked_ba = true;
                $pengajuan->pengajuan->finish_at = now();
                $pengajuan->pengajuan->save();
            }
        } else {
            try {
                $id = decrypt($data['id']);
            } catch (DecryptException $e) {
                abort(403, 'Payload tidak valid.');
            }
            //FOR ADMIN
            $dp = DetailPemohon::find($id);
            $dp->status = 3;
            $dp->save();
        }

        $this->alertMessageSuccess('Dokumen Berita Acara Berhasil Ditandatangi');
    }
    public function loadStatusDokumenPemohonTerbaru($userId, $dokumen_type_id)
    {
        $DokumenLatest = HistoryUploadDokumenPemohon::where('dokumen_type_id', $dokumen_type_id)
            ->where('user_id', $userId)
            ->latest()->first();
        return $DokumenLatest;
    }
    #[Computed()]
    public function LatestDokumenUser($userId, $dokId)
    {
        $hasDokComplete = HistoryUploadDokumenPemohon::where('user_id', $userId)
            ->where('dokumen_type_id', $dokId)
            ->latest()
            ->first();
        return $hasDokComplete;
    }
    #[Computed()]
    public function DokumenPemohon()
    {
        return DokumenPemohon::all();
    }
}
