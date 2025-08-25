<?php

namespace App\Models;

use MongoDB\Laravel\Auth\User as Authenticatable; // ⬅️ ganti ini, bukan dari Illuminate
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $connection = 'mongodb'; // ⬅️ wajib
    protected $collection = 'users';   // ⬅️ nama collection di MongoDB

    protected $fillable = [
        'name',
        'email',
        'password',
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
}
