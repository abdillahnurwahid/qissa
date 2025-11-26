<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function artikels()
    {
        return $this->hasMany(Artikel::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function contentRequests()
    {
        return $this->hasMany(ContentRequest::class);
    }

    public function hasFavorited($favoritable): bool
    {
        return $this->favorites()
            ->where('favoritable_type', get_class($favoritable))
            ->where('favoritable_id', $favoritable->id)
            ->exists();
    }
}