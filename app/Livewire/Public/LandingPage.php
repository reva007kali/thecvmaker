<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;


#[Layout('components.layouts.public')] 
#[Title('Home Page')]
class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.public.landing-page');
    }
}
