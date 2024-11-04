<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model
{
    use SoftDeletes;

    protected $table = 'detail_transaksi';

    protected $fillable = [
        'id_transaksi', 'id_menu', 'jumlah_pesanan', 'sub_total', 'harga_menu'
    ];

    // Relasi dengan Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    // Relasi dengan Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}
