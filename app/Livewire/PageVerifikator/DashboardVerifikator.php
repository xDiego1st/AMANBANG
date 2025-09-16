<?php

namespace App\Livewire\PageVerifikator;

use App\Traits\WithDataStatistic;
use Livewire\Component;

class DashboardVerifikator extends Component
{
    use WithDataStatistic;

    public function render()
    {
        return view('livewire.page-verifikator.dashboard-verifikator')->layout('layouts.base')->layoutData(
            [
                'title' => 'APLIKASI MANAJEMEN BANGUNAN GEDUNG',
            ]);
    }
}
