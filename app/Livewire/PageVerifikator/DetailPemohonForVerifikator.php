<?php

namespace App\Livewire\PageVerifikator;

use Livewire\Component;

class DetailPemohonForVerifikator extends Component
{
    public function render()
    {
        return view('livewire.page-verifikator.detail-pemohon-for-verifikator')->layout('layouts.base')->layoutData(
            [
                'title' => 'APLIKASI MANAJEMEN BANGUNAN GEDUNG',
            ]);
    }
}
