<?php

namespace App\Livewire;

use Livewire\Component;

class VerifikasiDokumen extends Component
{
    // Parameter dari URL
    public string $kode;
    public function mount(string $kode): void
    {
        // Simpan kode untuk referensi di view
        $this->kode = $kode;
        dd(decrypt($kode));
    }
    public function render()
    {
        return view('livewire.verifikasi-dokumen');
    }
}
