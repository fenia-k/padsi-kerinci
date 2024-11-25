<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Menambahkan kolom 'role' ke dalam fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Check if the user has a specific role.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Override the default findForPassport method to allow login using email or name.
     *
     * @param string $identifier
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function findForPassport($identifier)
    {
        return $this->where('email', $identifier)->orWhere('name', $identifier)->first();
    }

    /**
     * Automatically create a User account for DataPengguna.
     *
     * @param  \App\Models\DataPengguna  $dataPengguna
     * @return static
     */
    public static function createFromDataPengguna($dataPengguna)
    {
        // Generate a random password or a default password
        $randomPassword = \Illuminate\Support\Str::random(8);

        return self::create([
            'name' => $dataPengguna->nama_pengguna,
            'email' => strtolower(str_replace(' ', '.', $dataPengguna->nama_pengguna)) . '@example.com', // Membuat email default
            'password' => bcrypt($randomPassword),
            'role' => $dataPengguna->role->nama_role, // Assuming `role` relation exists in DataPengguna
        ]);
    }
}