<?php

namespace App\Livewire\Page\PageVerifikator;

use Livewire\Component;

class RiwayatPengajuanSelesai extends Component
{
    public function render()
    {
        return view('livewire.page.page-verifikator.riwayat-pengajuan-selesai')->layout('layouts.base')->layoutData(
            [
                'title' => 'Riwayat Daftar Pengajuan Selesai',
            ]);
    }
}
