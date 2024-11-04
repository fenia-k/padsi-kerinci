<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;

    protected $table = 'menu';

    protected $fillable = [
        'nama_menu', 'harga_menu', 'jumlah_menu', 'deskripsi_menu', 'gambar_menu'
    ];

    // Relasi dengan DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_menu');
    }
}
