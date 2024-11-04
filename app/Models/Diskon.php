<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diskon extends Model
{
  

    protected $table = 'diskon';

    protected $fillable = [
        'harga_diskon', 'batas_pemakaian', 'id_pelanggan'
    ];

    // Relasi dengan DataPelanggan
    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan');
    }
}
