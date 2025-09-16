<?php

namespace App\Traits;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

trait WithCustomPagination
{
    use WithPagination;
    use WithSweetAlert;

    public $uniqueId; // properti untuk menampung kunci unik
    public $totalAllData;
    public $textSearch;
    public $perPage = 10;
    public $show = [10, 20, 50, 100];
    public $order = 'desc';
    public $selected = [];
    public $selectedID;
    public $selectAll = false;
    public $totalData;

    //For Filter
    #[Url]
    public $start_time, $end_time, $start_date, $end_date;
    public $bulkAction;
    public $withTrash = false;

    public function updatedTextSearch()
    {
        $this->setPage(1);
    }
    public function selectAlls()
    {
        $this->selectAll = !$this->selectAll;
        $data = $this->search()->get();
        $this->selected = $data->map(function ($item) {
            return $item->id;
        })->toArray();
        if (!$this->selectAll) {
            $this->selected = [];
        }
    }
    public function resetSelect()
    {
        $this->selectAll = false;
        $this->selected = []; // reset
    }
    public function selectID($id)
    {
        array_push($this->selected, $id);
    }
    public function debugSelected()
    {
        dd($this->selected);
    }

    public function bulkButton()
    {
        if ($this->selected == null) {
            $msg = 'Pilih Data Terlebih Dahulu!.';
            $this->alertMessage("error", $msg, 'Data Belum Dipilih , Silahkan Menggunakan Feature Select All atau Pilih Data Secara Satu per Satu Melalui Select Box');
        } else {
            $this->alertEvent("warning", "Apa Kamu Yakin ?", "Kamu Telah Memilih Total [" . count($this->selected) . "] Data yang Dipilih", "bulkAction", $this->selected);
        }
    }

    #[On('refreshtable')]
    public function refreshtables()
    {
        $this->dispatch('$refresh');
    }

    // // Function Untuk Menghandle ketika modal ditutup
    // #[On('TriggerWhenClosedModals')]
    // public function TriggerWhenClosedModals()
    // {
    //     // untuk mereset ketika modal di close
    //     $this->resetErrorBag();
    //     $this->resetValidation();
    //     $this->reset();
    //     $this->dispatch('resetSelect2Modal');
    // }
}
