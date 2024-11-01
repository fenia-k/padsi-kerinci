<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPengguna extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'data_pengguna';

    protected $fillable = ['nama', 'email', 'password']; // sesuaikan dengan kolom tabel
}
