<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cv extends Model
{
    use SoftDeletes;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function educations()
    {
        return $this->hasMany(Education::class)->orderBy('position');
    }
    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('position');
    }
    public function softSkills()
    {
        return $this->hasMany(SoftSkill::class)->orderBy('position');
    }
    public function hardSkills()
    {
        return $this->hasMany(HardSkill::class)->orderBy('position');
    }
    public function languages()
    {
        return $this->hasMany(Language::class)->orderBy('position');
    }
    public function certifications()
    {
        return $this->hasMany(Certificate::class)->orderBy('position');
    }
    public function achievements()
    {
        return $this->hasMany(Achievement::class)->orderBy('position');
    }
    public function references()
    {
        return $this->hasMany(Reference::class)->orderBy('position');
    }
    public function socialMedia()
    {
        return $this->hasMany(SocialMedia::class)->orderBy('position');
    }
    public function seaExperiences()
    {
        return $this->hasMany(SeaExperience::class)->orderBy('position');
    }
    public function documents()
    {
        return $this->hasMany(Document::class)->orderBy('position');
    }
    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}
