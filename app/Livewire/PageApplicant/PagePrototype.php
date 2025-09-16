<?php

namespace App\Livewire\PageApplicant;

use App\Livewire\Forms\PrototypeForm;
use App\Models\Prototype;
use App\Traits\WithCustomPagination;
use App\Traits\WithModelValue;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class PagePrototype extends Component
{
    use WithCustomPagination;
    use WithModelValue;
    use WithFileUploads;

    public PrototypeForm $form;

    // state upsert + delete
    public ?int $editId = null;
    public ?int $confirmingDeleteId = null;

    #[Computed]
    public function getDataPrototype()
    {
        return Prototype::latest('id')->get();
    }

    public function startAdd(): void
    {
        $this->reset('editId');
        $this->form->reset(); // kosongkan field
        $this->form->model = null;

        $this->dispatch('open-modal', id: 'modalUpsert');
    }

    public function startEdit(int $id): void
    {
        $this->editId = $id;
        $this->form->set(Prototype::findOrFail($id));

        $this->dispatch('open-modal', id: 'modalUpsert');
    }

    public function saveUpsert(): void
    {
        $this->form->persist();

        $this->dispatch('close-modal', id: 'modalUpsert');
        $this->reset(['editId']);
        // Optional: $this->dispatch('notify', type:'success', message:'Berhasil disimpan');
    }

    public function confirmDelete(int $id): void
    {
        $this->confirmingDeleteId = $id;
        $this->dispatch('open-modal', id: 'modalDelete');
    }

    public function deleteConfirmed(): void
    {
        if (!$this->confirmingDeleteId) {
            return;
        }

        Prototype::findOrFail($this->confirmingDeleteId)->delete();

        $this->dispatch('close-modal', id: 'modalDelete');
        $this->reset('confirmingDeleteId');
    }

    // Function Untuk Menghandle ketika modal ditutup
    #[On('TriggerWhenClosedModals')]
    public function TriggerWhenClosedModals()
    {
        // untuk mereset ketika modal di close
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
        $this->dispatch('resetSelect2Modal');
    }

    public function render()
    {
        return view('livewire.page-applicant.page-prototype')
            ->layout('layouts.base')
            ->layoutData(['title' => 'SISTEM PERCEPATAN SIMBG']);
    }
}
