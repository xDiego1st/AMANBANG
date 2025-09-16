<?php

namespace App\Livewire\Page\PageOperator;

use Livewire\Component;

class DaftarRekapKrkPemohon extends Component
{
    public function render()
    {
        return view('livewire.page.page-operator.daftar-rekap-krk-pemohon')->layout('layouts.base')->layoutData(
            [
                'title' => 'AMANBANG | Aplikasi Manajemen Bangunan Gedung',
            ]);
    }
}
