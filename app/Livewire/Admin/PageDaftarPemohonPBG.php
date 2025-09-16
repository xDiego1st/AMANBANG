<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarPemohonPBG extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-pemohon-p-b-g')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
