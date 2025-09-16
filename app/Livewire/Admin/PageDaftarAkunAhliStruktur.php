<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarAkunAhliStruktur extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-akun-ahli-struktur')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
