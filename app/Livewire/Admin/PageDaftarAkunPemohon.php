<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarAkunPemohon extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-akun-pemohon')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
