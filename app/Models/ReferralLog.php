<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLog extends Model
{
    use HasFactory;

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'referrer_user_id',    // ID dari pengguna yang memberikan referral
        'referred_user_id',    // ID dari pengguna yang menggunakan referral
        'transaction_id',      // ID transaksi di mana referral digunakan
        'poin',                // Jumlah poin yang diberikan dalam transaksi ini
        'used_at',             // Waktu ketika referral digunakan
    ];

    /**
     * Relasi ke model DataPelanggan sebagai referrer (pemilik kode referral)
     */
    public function referrer()
    {
        return $this->belongsTo(DataPelanggan::class, 'referrer_user_id');
    }

    /**
     * Relasi ke model DataPelanggan sebagai pengguna yang direferensikan
     */
    public function referred()
    {
        return $this->belongsTo(DataPelanggan::class, 'referred_user_id');
    }

    /**
     * Relasi ke model Transaksi untuk transaksi di mana kode referral digunakan
     */
    public function transaction()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id');
    }
}
