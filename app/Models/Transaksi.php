<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $table = 'transaksi';

    protected $fillable = [
        'total_harga',
        'nominal',
        'tanggal_transaksi',
        'id_pelanggan',
        'id_pengguna',
        'diskon',        // Kolom baru untuk menyimpan diskon
        'kode_referal',  // Kolom baru untuk menyimpan kode referral
    ];

    // Relasi dengan DataPelanggan
    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan');
    }

    // Relasi dengan DataPengguna
    public function pengguna()
    {
        return $this->belongsTo(DataPengguna::class, 'id_pengguna');
    }

    // Relasi dengan DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    // Relasi dengan ReferralLog (jika transaksi ini melibatkan kode referral)
    public function referralLog()
    {
        return $this->hasOne(ReferralLog::class, 'transaction_id');
    }
}
