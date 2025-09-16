<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarAkunPengawas extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-akun-pengawas')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
