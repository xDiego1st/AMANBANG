<?php

namespace App\Livewire\Data;

use App\Models\DetailPemohon;
use App\Models\HistoryUploadDokumenPemohon;
use App\Traits\WithCustomPagination;
use App\Traits\WithModelValue;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;

class TableUploadDokumenPemohon extends Component
{
    use WithCustomPagination;
    use WithModelValue;
    #[Locked]
    public $ids;

    public function mount()
    {
        $this->uniqueId = Str::random(8);
    }
    public function render()
    {
        $query = $this->DokumenPemohon();
        $data = $query->paginate($this->perPage, ['*'], 'page');
        return view('livewire.data.table-upload-dokumen-pemohon', [
            'data' => $data,
        ]);
    }

    public function DokumenPemohon()
    {

        $userId = Auth::user()->id;

        // Step 1: Get latest dates for each dokumen_type_id for the current user
        $latestDatesSubquery = HistoryUploadDokumenPemohon::select(DB::raw('MAX(created_at) as latest_date'), 'dokumen_type_id')
            ->where('user_id', $userId)
            ->where('pengajuan_id', $this->ids)
            ->groupBy('dokumen_type_id');

        // Step 2: Join the main table with the subquery to get all columns
        $latestRecords = HistoryUploadDokumenPemohon::where('user_id', $userId)
            ->joinSub($latestDatesSubquery, 'latest_dates', function ($join) {
                $join->on('history_upload.dokumen_type_id', '=', 'latest_dates.dokumen_type_id')
                    ->on('history_upload.created_at', '=', 'latest_dates.latest_date');
            });

        $this->totalData = $latestDatesSubquery->count(); // Menghitung total data sebelum paginasi
        return $latestRecords;
    }
    public function downloadMedia($dokId,$collectionName)
    {
        $dp = DetailPemohon::findOrFail($this->ids);
        $lh = $dp->LatestDokumenUser($dokId);

        // cek apakah ada media di koleksi ini
        if (!$lh->hasMedia($collectionName)) {
            abort(404, 'File tidak ditemukan.');
        }

        // ambil media pertama dari koleksi
        $media = $lh->getFirstMedia($collectionName);
        $filePath = $media->getPath();
        $fileName = "[" . now() . "] " . $collectionName . "_" . $dp->nama_bangunan; // nama asli yg disimpan

        return response()->streamDownload(function () use ($filePath) {
            readfile($filePath);
        }, $fileName, [
            'Content-Type' => $media->mime_type ?? 'application/octet-stream',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
        ]);
    }

}
