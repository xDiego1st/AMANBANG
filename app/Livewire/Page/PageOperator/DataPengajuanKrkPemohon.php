<?php

namespace App\Livewire\Page\PageOperator;

use Livewire\Component;

class DataPengajuanKrkPemohon extends Component
{
    public function render()
    {
        return view('livewire.page.page-operator.data-pengajuan-krk-pemohon')->layout('layouts.base')->layoutData(
            [
                'title' => 'AMANBANG | Aplikasi Manajemen Bangunan Gedung',
            ]);
    }
}
