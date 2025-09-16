<?php

namespace App\Livewire\Modals;

use App\Models\DetailPemohon;
use App\Models\User;
use App\Traits\WithCustomTraits;
use App\Traits\WithSweetAlert;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

class ModalUploadKRKPemohon extends Component
{
    #[Locked]
    public $ids;
    public function render()
    {
        return view('livewire.modals.modal-upload-k-r-k-pemohon');
    }
    #[On('modal-upload-krk-pemohon')]
    public function OpenModal($ids = null)
    {
        if($ids){
            $this->ids = $ids;
        }
        $this->dispatch('open-modal', targetId: "modalsUploadKRKPemohon");
    }

    // Function Untuk Menghandle ketika modal ditutup
    #[On('TriggerWhenClosedModals')]
    public function TriggerWhenClosedModals()
    { // untuk mereset ketika modal di close
        $this->reset();
        $this->dispatch('resetSelect2Modal');
    }
}
