<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarPengajuanKrk extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-pengajuan-krk')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Pengajuan KRK',
            ]);
    }
}
