<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class dateselector extends Component
{

    public $label;
    public $withDay;


    public function __construct($label = null, $withDay = true)
    {
        $this->label = $label;
        $this->withDay = $withDay;
    }


    public function render(): View|Closure|string
    {
        return view('components.date-selector');
    }
}
