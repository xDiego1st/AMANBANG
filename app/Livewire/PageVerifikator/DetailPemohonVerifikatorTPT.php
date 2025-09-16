<?php

namespace App\Livewire\PageVerifikator;

use App\Models\DetailPemohon;
use App\Models\DokumenPemohon;
use App\Models\JenisKeteranganPemohon;
use App\Models\KeteranganDetailUploadPemohon;
use App\Traits\WithModelValue;
use App\Traits\WithSweetAlert;
use Illuminate\Contracts\Encryption\DecryptException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class DetailPemohonVerifikatorTPT extends Component
{
    public $data;
    public function mount($id)
    {
        try {
            $id = decrypt($id);
        } catch (DecryptException $e) {
            abort(403);
        }
        $this->data = DetailPemohon::find($id);
    }
    public function render()
    {
        return view('livewire.page-verifikator.detail-pemohon-verifikator-t-p-t')->layout('layouts.base')->layoutData(
            [
                'title' => 'APLIKASI MANAJEMEN BANGUNAN GEDUNG',
            ]);
    }
    #[Computed]
    public function loadDokumen()
    {
        $dok = DokumenPemohon::all();
        return $dok;
    }
}
