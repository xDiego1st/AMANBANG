<?php

namespace App\Livewire\Data;

use App\Exports\MultipleSheetExport;
use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Traits\WithCustomPagination;
use App\Traits\WithModelValue;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class TablePengajuanPemohon extends Component
{
    use WithCustomPagination;
    use WithModelValue;

    #[Locked]
    public $ids;

    public $jenis_pengajuan;
    public function mount()
    {
        $this->uniqueId = $this->id();
    }
    public function render()
    {
        $query = $this->search();
        $data = $query->paginate($this->perPage, ['*'], 'page');
        return view('livewire.data.table-pengajuan-pemohon', [
            'data' => $data,
        ]);
    }

    private function search()
    {
        $search = '%' . $this->textSearch . '%';
        // Main query
        $query = DetailPemohon::join('users', 'detail_pemohons.user_id', '=', 'users.id')
            ->where(function ($query) use ($search) {
                $query->Where('detail_pemohons.jenis_pengajuan', 'like', $search)
                    ->orWhere('detail_pemohons.nama_bangunan', 'like', $search)
                    ->orWhere('detail_pemohons.nomor_registrasi_simbg', 'like', $search);
            })->where('users.id', Auth()->user()->id)
            ->orderBy('tgl_pengajuan', $this->order)
            ->select('detail_pemohons.*', 'detail_pemohons.id as detail_id', 'detail_pemohons.created_at as tgl_pengajuan', 'users.email as user_email', 'users.status_account', 'users.last_login_at', 'users.last_seen', 'users.last_login_ip', 'users.status_account');
        $this->totalData = $query->count(); // Menghitung total data sebelum paginasi

        return $query; // Mengembalikan hasil query
    }

    public function exportData()
    {
        $fileName = 'Data_Ppengajuan_pemohon' . now()->format('YmdHis') . '.xlsx';
        return (new MultipleSheetExport($this->search()))->download($fileName);
    }
    #[Computed]
    public function LatestDokumenUser($userId, $dokId)
    {
        $hasDokComplete = HistoryUploadDokumenPemohon::where('user_id', $userId)
            ->where('dokumen_type_id', $dokId)
            ->latest()
            ->first();
        return $hasDokComplete;
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

    #[Computed]
    public function DokumenPemohon()
    {
        return DokumenPemohon::all();
    }
    #[Computed]
    public function loadStatusDokumenPemohonTerbaru($userId, $dokumen_type_id, $pengajuan_id)
    {
        $DokumenLatest = HistoryUploadDokumenPemohon::where('dokumen_type_id', $dokumen_type_id)
            ->where('user_id', $userId)
            ->where('pengajuan_id', $pengajuan_id)
            ->latest()->first();
        return $DokumenLatest;
    }
    public function resetFilter()
    {
        //ClearFilter
        // dd('Clear Filter');
    }
    public function openModalAsk($action, $id)
    {
        $dp = DetailPemohon::find($id);
        $this->alertEvent("warning", "Apa Kamu Yakin Melakukan " . $action . " pada data #" . $dp->nama_bangunan . "?", "Data yang telah diubah tidak dapat dikembalikan seperti semula, harap gunakan secara hati hati!", "action-table-pengajuan-pemohon",
            ['action' => $action,
                'id' => $id,
            ]);
    }
    #[On('action-table-pengajuan-pemohon')]
    public function askAction($data)
    {
        // $data=collect($data);
        if ($data['action'] == "Delete") {
            $dp = DetailPemohon::find($data['id']);
            $dp->delete();
            $this->alertMessage(
                "success",
                "Penghapusan Data Berhasil",
                "Data yang Anda pilih telah berhasil dihapus dari sistem. Tindakan ini tidak dapat dibatalkan.",
                3000
            );
        }

    }

}
