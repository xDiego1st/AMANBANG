<?php

namespace App\Livewire\PageApplicant;

use App\Traits\WithDataStatistic;
use Livewire\Component;

class PageListTableBangunanPemohon extends Component
{
    use WithDataStatistic;

    protected $listeners = ['refreshtable' => '$refresh'];

    public function render()
    {
        return view('livewire.page-applicant.page-list-table-bangunan-pemohon')->layout('layouts.base')->layoutData(
            [
                'title' => 'Aplikasi Manajemen Bangunan Gedung',
            ]);
    }
}
