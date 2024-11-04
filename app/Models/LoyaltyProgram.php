<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyProgram extends Model
{
    use SoftDeletes;

    protected $table = 'loyalty_program';

    protected $fillable = [
        'kode_referral',
        'batas_loyalty',
        'id_pelanggan',
    ];

    /**
     * Relasi dengan DataPelanggan
     * Menghubungkan program loyalti dengan pelanggan
     */
    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan');
    }

    /**
     * Relasi dengan Transaksi
     * Menghubungkan program loyalti dengan transaksi
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'kode_referal', 'kode_referral');
    }

    /**
     * Accessor untuk format batas loyalti
     * Misalnya untuk ditampilkan dengan "x"
     */
    public function getFormattedBatasLoyaltyAttribute()
    {
        return $this->batas_loyalty . 'x';
    }

    /**
     * Mengurangi batas loyalti
     * Gunakan fungsi ini ketika kode referral digunakan dalam transaksi
     */
    public function reduceLoyalty()
    {
        if ($this->batas_loyalty > 0) {
            $this->decrement('batas_loyalty');
        }
    }
}
