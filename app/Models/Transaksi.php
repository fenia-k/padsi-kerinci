<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi';

    protected $fillable = [
        'total_harga',
        'nominal',
        'tanggal_transaksi',
        'id_pelanggan',
        'id_pengguna',
        'id_menu',        // Kolom untuk menyimpan ID menu
        'diskon',         // Kolom untuk menyimpan diskon
        'kode_referal',   // Kolom untuk menyimpan kode referral
        'poin_digunakan', // Kolom untuk menyimpan poin yang digunakan
        'jumlah', 
    ];

    // Relasi dengan model DataPelanggan
    public function pelanggan()
    {
        return $this->belongsTo(DataPelanggan::class, 'id_pelanggan');
    }

    // Relasi dengan model DataPengguna
    public function pengguna()
    {
        return $this->belongsTo(DataPengguna::class, 'id_pengguna');
    }

    // Relasi dengan model Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }

    // Relasi dengan model DetailTransaksi
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    // Relasi dengan model ReferralLog
    public function referralLog()
    {
        return $this->hasOne(ReferralLog::class, 'transaction_id');
    }

    // Scope untuk mencari transaksi berdasarkan tanggal
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('tanggal_transaksi', $date);
    }

    // Scope untuk mencari transaksi yang menggunakan kode referral tertentu
    public function scopeByReferralCode($query, $kodeReferal)
    {
        return $query->where('kode_referal', $kodeReferal);
    }

    // Scope untuk mencari transaksi berdasarkan pengguna (kasir)
    public function scopeByUser($query, $userId)
    {
        return $query->where('id_pengguna', $userId);
    }

    // Scope untuk transaksi dalam rentang tanggal tertentu
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
    }

    // Custom attribute untuk menghitung kembalian
    public function getKembalianAttribute()
    {
        return $this->nominal - $this->total_harga;
    }

    // Custom method untuk format tanggal
    public function formattedDate()
    {
        return \Carbon\Carbon::parse($this->tanggal_transaksi)->format('d M Y');
    }
}
