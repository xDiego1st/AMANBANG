<?php

namespace App\Livewire\Page\Login;

use Livewire\Component;

class ProfileSettings extends Component
{
    public function render()
    {
        return view('livewire.page.login.profile-settings')->layout('layouts.base')->layoutData(['title' => 'Profile Settings']);
    }
}
