<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPengguna extends Model
{
    use SoftDeletes;

    protected $table = 'data_pengguna';

    protected $fillable = [
        'nama_pengguna', 'alamat_pengguna', 'noHP_pengguna', 'id_role'
    ];

    // Relasi dengan Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id'); 
    }

    // Relasi dengan Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pengguna');
    }
}
