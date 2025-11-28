<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Experience extends Model
{
    protected $guarded =[];

    protected function endDate(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => empty($value) ? null : $value,
        );
    }
    public function cv(){ return $this->belongsTo(Cv::class); }
}
