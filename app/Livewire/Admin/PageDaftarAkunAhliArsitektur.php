<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarAkunAhliArsitektur extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-akun-ahli-arsitektur')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
