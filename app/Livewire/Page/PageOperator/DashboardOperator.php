<?php

namespace App\Livewire\Page\PageOperator;

use App\Traits\WithDataStatistic;
use Livewire\Component;

class DashboardOperator extends Component
{
    use WithDataStatistic;
    public function render()
    {
        return view('livewire.page.page-operator.dashboard-operator');
    }
}
