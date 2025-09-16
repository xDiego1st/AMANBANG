<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarAkunAhliTataBangunan extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-akun-ahli-tata-bangunan')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
