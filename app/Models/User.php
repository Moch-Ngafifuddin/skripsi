<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'akses_menu', //
        'meja_tugas', //
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Daftarkan semua casting di sini (Laravel 11 Style)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'akses_menu' => 'array', //
        ];
    }
}