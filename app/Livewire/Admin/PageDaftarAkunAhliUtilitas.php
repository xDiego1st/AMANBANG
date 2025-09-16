<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class PageDaftarAkunAhliUtilitas extends Component
{
    public function render()
    {
        return view('livewire.admin.page-daftar-akun-ahli-utilitas')->layout('layouts.base')->layoutData(
            [
                'title' => 'Daftar Akun Ahli Arsitektur',
            ]);
    }
}
