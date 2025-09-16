<?php

namespace App\Livewire\Page\Login;

use App\Models\User;
use Livewire\Component;

class WebManages extends Component
{
    public function render()
    {
        $useradmin = User::where('role', '!=', 'User')->get();
        return view('livewire.page.login.web-manages', [
            'data' => $useradmin,
        ])->layout('layouts.base')->layoutData(['title' => 'Web Settings']);
    }
}
