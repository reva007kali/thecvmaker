<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $guarded = [];
    public function cvs()
    {
        return $this->hasMany(Cv::class);
    }
}
