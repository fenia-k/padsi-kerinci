<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_user_id',
        'referred_user_id',
        'transaction_id',
        'used_at',
    ];

    public function referrer()
    {
        return $this->belongsTo(DataPelanggan::class, 'referrer_user_id');
    }

    public function referred()
    {
        return $this->belongsTo(DataPelanggan::class, 'referred_user_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaksi::class, 'transaction_id');
    }
}

