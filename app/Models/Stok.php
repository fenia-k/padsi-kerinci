<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stok extends Model
{
    use SoftDeletes;

    protected $table = 'stok';

    protected $fillable = [
        'nama_stok', 'jumlah_stok',
    ];
}
