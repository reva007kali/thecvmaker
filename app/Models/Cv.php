<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $guarded = [];

    protected $casts = [
        'social_media' => 'array',
        'education' => 'array',
        'work_experience' => 'array',
        'certifications' => 'array',
        'achievements' => 'array',
        'soft_skills' => 'array',
        'hard_skills' => 'array',
        'languages' => 'array',
        'references' => 'array',
        'birthdate' => 'date',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
