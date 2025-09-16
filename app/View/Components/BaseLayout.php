<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class BaseLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public $test="34";
    public function render(): View
    {
        return view('layouts.base');
    }
}
