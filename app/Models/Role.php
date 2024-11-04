<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';

    protected $fillable = [
        'nama_role'
    ];

    // Relasi dengan DataPengguna
    public function pengguna()
    {
        return $this->hasMany(DataPengguna::class, 'id_role');
    }
}
