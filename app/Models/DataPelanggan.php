<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DataPelanggan extends Model
{
    use SoftDeletes;

    protected $table = 'data_pelanggan';

    protected $fillable = [
        'nama_pelanggan', 'alamat_pelanggan', 'noHP_pelanggan', 'kode_referal'
    ];

    // Relasi dengan Diskon
    public function diskon()
    {
        return $this->hasMany(Diskon::class, 'id_pelanggan');
    }

    // Relasi dengan LoyaltyProgram
    public function loyaltyProgram()
    {
        return $this->hasMany(LoyaltyProgram::class, 'id_pelanggan');
    }

    // Relasi dengan Transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan');
    }
}
