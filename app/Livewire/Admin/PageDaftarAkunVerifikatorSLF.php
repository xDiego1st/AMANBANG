<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarAkunVerifikatorSLF extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-akun-verifikator-s-l-f')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
