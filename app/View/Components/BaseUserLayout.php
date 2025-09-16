<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class BaseUserLayout extends Component
{
    public function render(): View
    {
        return view('layouts.base-user');
    }
}
