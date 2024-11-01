<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiPenjualan extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'transaksi_penjualan';

    protected $fillable = ['produk', 'jumlah', 'total_harga', 'tanggal']; // sesuaikan dengan kolom tabel
}
