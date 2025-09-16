<?php

namespace App\Livewire\Modals;

use App\Models\User;
use App\Traits\WithSweetAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalSendMessageWA extends Component
{
    use WithSweetAlert;
    public $pemohon;
    public $isi_pesan_whatsapp;
    public function render()
    {
        return view('livewire.modals.modal-send-message-w-a');
    }

    //parsing data
    #[On('SelectedPemohon')]
    public function setPemohon($id)
    {
        $this->pemohon = User::find($id);
    }
    public function submit()
    {
        $this->validate();
        $header = "*InInformasi Aplikasi Manajemen Bangunan Gedung* (AMANBANG)\nYth." . ($this->pemohon->name ?? $this->pemohon->username ) . "\n";
        $pesan = $header . $this->isi_pesan_whatsapp;
        $this->pemohon->sendMessageWA($this->pemohon->no_wa, $pesan);
        $this->alertMessageSuccess('Pesan Whatsapp Telah Diteruskan Ke Pemohon');
        $this->dispatch('close-modal', targetId: "modalsSendMessageWa");

    }
    protected function rules()
    {

        $rules = [
            'isi_pesan_whatsapp' => 'required|min:5',
        ];
        return $rules;
    }
    // Function Untuk Menghandle ketika modal ditutup
    #[On('TriggerWhenClosedModals')]
    public function TriggerWhenClosedModals()
    { // untuk mereset ketika modal di close
        $this->reset();
        // $this->dispatch('resetSelect2Modal');

    }
}
