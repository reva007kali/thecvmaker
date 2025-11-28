<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_path',
        'project_url',
        'completed_date',
    ];

    protected $casts = [
        'completed_date' => 'date',
    ];

    // Setiap Portfolio milik 1 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
