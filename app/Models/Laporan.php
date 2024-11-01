<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'laporan';

    protected $fillable = ['judul', 'konten', 'tanggal']; // sesuaikan dengan kolom tabel
}
