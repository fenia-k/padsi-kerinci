<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi'; // Nama tabel yang sesuai di database

    protected $fillable = [
        'id_pelanggan',
        'id_pengguna',
        'tanggal_transaksi',
        'kode_referal',
        'total_harga',
        'jumlah',
        'nominal',
        'poin_digunakan',
    ];

    // Relasi ke model DataPelanggan
    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan');
    }

    // Relasi ke model DataPengguna
    public function pengguna()
    {
        return $this->belongsTo(DataPengguna::class, 'id_pengguna');
    }

    // Relasi ke model DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }
}
