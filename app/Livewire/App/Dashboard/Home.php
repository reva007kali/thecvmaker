<?php

namespace App\Livewire\App\Dashboard;

use Livewire\Component;

class Home extends Component
{
    public function mount()
{
    // Cek apakah user punya resume
    if (!auth()->user()->cv) {
        return redirect()->route('cv.form');
    }
}
    public function render()
    {
        return view('livewire.app.dashboard.home');
    }
}
