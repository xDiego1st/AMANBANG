<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarPemohonSLF extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-pemohon-s-l-f')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
