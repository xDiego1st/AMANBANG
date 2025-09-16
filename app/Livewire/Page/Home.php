<?php

namespace App\Livewire\Page;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('livewire.page.home')->layout('layouts.public')->layoutData(
            [
                'title' => 'SIAPBANG',
            ]);
    }
}
