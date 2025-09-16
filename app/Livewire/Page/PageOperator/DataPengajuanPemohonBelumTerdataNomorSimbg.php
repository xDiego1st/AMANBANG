<?php

namespace App\Livewire\Page\PageOperator;

use Livewire\Component;

class DataPengajuanPemohonBelumTerdataNomorSimbg extends Component
{
    public function render()
    {
        return view('livewire.page.page-operator.data-pengajuan-pemohon-belum-terdata-nomor-simbg')->layout('layouts.base')->layoutData(
            [
                'title' => 'AMANBANG | Aplikasi Manajemen Bangunan Gedung',
            ]);
    }
}
