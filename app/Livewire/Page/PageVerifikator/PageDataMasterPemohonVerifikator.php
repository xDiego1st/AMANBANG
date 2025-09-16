<?php

namespace App\Livewire\Page\PageVerifikator;

use Livewire\Component;

class PageDataMasterPemohonVerifikator extends Component
{
    public function render()
    {
        return view('livewire.page.page-verifikator.page-data-master-pemohon-verifikator')->layout('layouts.base')->layoutData(
            [
                'title' => 'Riwayat Daftar Pemohon',
            ]);
    }
}
