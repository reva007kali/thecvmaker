<?php

namespace App\Livewire;

use App\Models\Cv;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CvDataForm extends Component
{
    public $step = 1;
    // --- state fields ---
    public $cvId = null;
    public $first_name = '';
    public $last_name = '';
    public $cv_photo = null; // for now path string
    public $address = '';
    public $birthdate = null;
    public $phone = '';
    public $email = '';
    public $social_media = [];

    // repeaters (arrays of associative arrays)
    public $education = [];
    public $work_experience = [];
    public $certifications = [];
    public $achievements = [];
    public $soft_skills = [];
    public $hard_skills = [];
    public $languages = [];
    public $references = [];

    public $summary = '';



    public function render()
    {
        return view('livewire.cv-data-form');
    }
}
