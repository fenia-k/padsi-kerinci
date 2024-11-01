<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'menu';

    protected $fillable = ['nama', 'deskripsi', 'harga']; // sesuaikan dengan kolom tabel
}
