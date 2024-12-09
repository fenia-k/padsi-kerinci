<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model
{
    use SoftDeletes;

    protected $table = 'detail_transaksi'; // Pastikan nama tabel sesuai dengan database

    protected $fillable = [
        'id_transaksi',
        'id_menu',
        'jumlah_pesanan',
        'harga_menu',
        'sub_total',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
    
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu')->withDefault([
            'nama_menu' => 'Menu Tidak Ditemukan'  // Nilai default jika menu tidak ditemukan
        ]);
    }
    
}
