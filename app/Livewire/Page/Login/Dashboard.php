<?php

namespace App\Livewire\Page\Login;

use App\Models\Intervensi;
use App\Models\Stunting;
use Livewire\Attributes\On;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.page.login.dashboard')->layout('layouts.base')->layoutData(
            [
                'title' => 'Dashboard',
            ]);
    }
}
