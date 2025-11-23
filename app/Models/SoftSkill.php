<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftSkill extends Model
{
    protected $guarded =[];
    public function cv(){ return $this->belongsTo(Cv::class); }
}
