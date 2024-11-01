<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'stok';

    protected $fillable = ['nama_produk', 'jumlah', 'satuan']; // sesuaikan dengan kolom tabel
}
