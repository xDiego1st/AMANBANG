<?php

namespace App\Livewire\Data;

use App\Exports\MultipleSheetExport;
use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Traits\WithCustomPagination;
use App\Traits\WithModelValue;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Component;

class TablePemohonList extends Component
{
    use WithCustomPagination;
    use WithModelValue;

    #[Locked]
    public $ids;

    public $jenis_pengajuan;

    // protected $listeners = ['refreshtable' => '$refresh'];

    public function mount()
    {
        $this->uniqueId = Str::random(8);
    }
    public function render()
    {
        $query = $this->search();
        $data = $query->paginate($this->perPage, ['*'], 'page');
        return view('livewire.data.table-pemohon-list', [
            'data' => $data,
        ]);
    }

    private function search()
    {
        $search = '%' . $this->textSearch . '%';
        // Main query
        $query = DetailPemohon::join('users', 'detail_pemohons.user_id', '=', 'users.id')
            ->where(function ($query) use ($search) {
                $query->where('detail_pemohons.no_wa', 'like', $search)
                    ->orWhere('detail_pemohons.nama', 'like', $search)
                    ->orWhere('detail_pemohons.jenis_pengajuan', 'like', $search)
                    ->orWhere('detail_pemohons.nama_bangunan', 'like', $search)
                    ->orWhere('detail_pemohons.nomor_registrasi_simbg', 'like', $search)
                    ->orWhere('users.email', 'like', $search);
            })
            ->select('detail_pemohons.*', 'detail_pemohons.created_at as tgl_pengajuan', 'users.email as user_email', 'users.status_account', 'users.last_login_at', 'users.last_seen', 'users.last_login_ip', 'users.status_account');
        if ($this->jenis_pengajuan) {
            $query->where('detail_pemohons.jenis_pengajuan', $this->jenis_pengajuan);
            $query->whereNotNull('detail_pemohons.nomor_registrasi_simbg'); // Filter untuk nomor_registrasi_simbg yang tidak NULL
        } else {
            // $query->whereNull('detail_pemohons.nomor_registrasi_simbg');
        }
        $this->totalData = $query->count(); // Menghitung total data sebelum paginasi

        return $query; // Mengembalikan hasil query
    }

    public function exportData()
    {
        $fileName = 'Data_Ppengajuan_pemohon' . now()->format('YmdHis') . '.xlsx';
        return (new MultipleSheetExport($this->search()))->download($fileName);
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
    public function downloadBA($id)
    {
        $this->dispatch('open-tab', url: route('genarate.pdf.ba', ['idpengajuan' => encrypt($id)]));
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
    public function downloadMedia($id, $collectionName)
    {
        $dp = DetailPemohon::findOrFail($id);

        // cek apakah ada media di koleksi ini
        if (!$dp->hasMedia($collectionName)) {
            abort(404, 'File tidak ditemukan.');
        }

        // ambil media pertama dari koleksi
        $media = $dp->getFirstMedia($collectionName);
        $filePath = $media->getPath();
        $fileName = $media->file_name; // nama asli yg disimpan

        return response()->streamDownload(function () use ($filePath) {
            readfile($filePath);
        }, $fileName, [
            'Content-Type' => $media->mime_type ?? 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }
    #[Computed()]
    public function DokumenPemohon()
    {
        return DokumenPemohon::all();
    }
    #[Computed]
    public function loadStatusDokumenPemohonTerbaru($userId, $dokumen_type_id)
    {
        $DokumenLatest = HistoryUploadDokumenPemohon::where('dokumen_type_id', $dokumen_type_id)
            ->where('user_id', $userId)
            ->latest()->first();
        return $DokumenLatest;
    }
    public function resetFilter()
    {
        //ClearFilter
        dd('Clear Filter');
    }
}
