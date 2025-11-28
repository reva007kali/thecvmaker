<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Fortify\TwoFactorAuthenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */

    /**
     * Logic Otomatis saat User Dibuat
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            // Hanya generate jika username belum diisi
            if (empty($user->username)) {
                $user->username = self::generateUniqueUsername($user->name);
            }
        });
    }
    /**
     * Algoritma Generator Username Unik
     */
    public static function generateUniqueUsername($name)
    {
        // 1. Ubah nama jadi slug (contoh: "Budi Santoso" -> "budi-santoso")
        $slug = Str::slug($name);

        // Jika nama kosong (jarang terjadi), kasih default
        if (empty($slug)) {
            $slug = 'user-' . Str::random(5);
        }

        // 2. Cek apakah username ini sudah ada di database?
        $originalSlug = $slug;
        $count = 1;

        // Loop: Selama username masih ada di DB, tambahkan angka
        while (User::where('username', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count; // budi-santoso-1, budi-santoso-2
            $count++;
        }

        return $slug;
    }
    protected $hidden = [
        'password',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class)->latest();
    }

    public function cv()
    {
        return $this->hasOne(Cv::class);
    }
}
