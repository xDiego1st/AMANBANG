<?php

namespace App\Livewire\Modals;

use App\Models\DetailPemohon;
use App\Models\Kelurahan;
use App\Models\Notification;
use App\Models\User;
use App\Traits\WithModelValue;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalPemohonCreateEdit extends Component
{
    #[Locked]
    public $ids;
    public function render()
    {
        return view('livewire.modals.modal-pemohon-create-edit');
    }

    #[On('modal-pengajuan-bangunan-pemohon')]
    public function OpenModalPemohonCreateEdit($ids = null)
    {
        if($ids){
            $this->ids = $ids;
        }
        $this->dispatch('open-modal', targetId: "modalsPendataanPengajuanPemohon");
    }

    // Function Untuk Menghandle ketika modal ditutup
    #[On('TriggerWhenClosedModals')]
    public function TriggerWhenClosedModals()
    { // untuk mereset ketika modal di close
        $this->reset();
        $this->dispatch('resetSelect2Modal');
    }

}
