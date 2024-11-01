<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Tentukan nama tabel
    protected $table = 'role';

    protected $fillable = ['nama']; // sesuaikan dengan kolom tabel
}
