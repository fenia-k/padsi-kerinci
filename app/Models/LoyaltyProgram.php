<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoyaltyProgram extends Model
{
    use SoftDeletes;

    protected $table = 'loyalty_program';

    protected $fillable = [
        'kode_referral', 'batas_loyalty', 'diskon', 'id_pelanggan'
    ];

    // Relasi dengan DataPelanggan
    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan');
    }

    // Accessor untuk format diskon (misalnya untuk ditampilkan dalam format Rp)
    public function getFormattedDiskonAttribute()
    {
        return 'Rp ' . number_format($this->diskon, 0, ',', '.');
    }

    // Accessor untuk batas loyalty (misalnya untuk ditampilkan dengan "x")
    public function getFormattedBatasLoyaltyAttribute()
    {
        return $this->batas_loyalty . 'x';
    }
}
