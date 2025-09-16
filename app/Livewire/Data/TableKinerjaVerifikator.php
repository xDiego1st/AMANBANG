<?php

namespace App\Livewire\Data;

use App\Exports\MultipleSheetExport;
use App\Models\User;
use App\Traits\WithCustomPagination;
use App\Traits\WithModelValue;
use Livewire\Component;

class TableKinerjaVerifikator extends Component
{
    use WithCustomPagination;
    use WithModelValue;
    public function render()
    {
        $query = $this->search();
        $data = $query->paginate($this->perPage, ['*'], 'page');
        return view('livewire.data.table-kinerja-verifikator', [
            'data' => $data,
        ]);
    }
    private function search()
    {
        $search = '%' . $this->textSearch . '%';
        // Main query
        $query = User::with(
            'verifikator.pengajuan',
            'verifikator.user',
        )->wherein('role', ['VERIFIKATOR','ADMIN','PENGAWAS']);
        $this->totalData = $query->count(); // Menghitung total data sebelum paginasi
        return $query; // Mengembalikan hasil query
    }

    public function exportData()
    {
        $fileName = 'Data_Pengajuan_pemohon' . now()->format('YmdHis') . '.xlsx';
        return (new MultipleSheetExport($this->search()))->download($fileName);
    }
}
