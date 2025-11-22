<?php

namespace App\Livewire;

use App\Models\Cv;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CvPreview extends Component
{

   public $cv;

    public function mount()
    {
        // Ambil CV milik user login saja
        $this->cv = Cv::where('user_id', Auth::id())->first();
    }
    public function render()
    {
        return view('livewire.cv-preview');
    }
}
