<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        'email' // Tambahkan kolom email agar bisa diisi saat membuat pengguna baru
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

    /**
     * Booted event untuk membuat akun user di tabel users setelah DataPengguna dibuat
     */
    protected static function booted()
    {
        static::created(function ($pengguna) {
            $pengguna->createUserAccount();
        });
    }

    /**
     * Fungsi untuk membuat akun user di tabel users secara otomatis
     */
    public function createUserAccount()
    {
        // Mengambil data untuk akun user
        $username = $this->nama_pengguna;
        $email = $this->email;
    
        // Periksa apakah user dengan email ini sudah ada
        if (User::where('email', $email)->exists()) {
            // Jika user dengan email ini sudah ada, kita bisa memutuskan untuk tidak membuat ulang akun atau memberikan pesan/error
            return;
        }
    
        // Generate password default atau random
        $password = Hash::make('password123'); // Ubah jika perlu atau gunakan random
        // Alternatif random password: $password = Hash::make(Str::random(8));
    
        // Ambil role pengguna, fallback ke 'pegawai' jika role tidak ditemukan
        $role = $this->role ? $this->role->nama_role : 'pegawai';
    
        // Membuat akun di tabel users
        User::create([
            'name' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);
    }
}       
