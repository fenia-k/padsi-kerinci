<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoyaltyProgram extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'loyalty_program';

    protected $fillable = ['nama_program', 'deskripsi', 'poin']; // sesuaikan dengan kolom tabel
}
