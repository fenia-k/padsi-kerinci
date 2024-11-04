<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPengguna extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'data_pengguna';

    // Kolom yang bisa diisi massal
    protected $fillable = [
        'nama_pengguna', 
        'alamat_pengguna', 
        'noHP_pengguna', 
        'id_role',
    ];

    /**
     * Relasi dengan model Role
     * Menghubungkan DataPengguna dengan peran yang diberikan
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id'); 
    }

    /**
     * Relasi dengan model Transaksi
     * Menghubungkan DataPengguna dengan transaksi yang dibuat oleh pengguna ini
     */
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_pengguna');
    }

    /**
     * Scope untuk pencarian berdasarkan nama pengguna
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByName($query, $name)
    {
        return $query->where('nama_pengguna', 'like', "%$name%");
    }

    /**
     * Scope untuk mencari berdasarkan nomor telepon pengguna
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $phoneNumber
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByPhone($query, $phoneNumber)
    {
        return $query->where('noHP_pengguna', 'like', "%$phoneNumber%");
    }
}
