<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPelanggan extends Model
{
    use HasFactory;

    protected $table = 'data_pelanggan';
    protected $primaryKey = 'ID_PELANGGAN';
    public $incrementing = false; // Karena primary key bukan integer
    protected $keyType = 'string';

    protected $fillable = [
        'ID_PELANGGAN', 
        'ID_RUJUKAN', 
        'NAMA_PELANGGAN', 
        'NOHP_PELANGGAN', 
        'ALAMAT_PELANGGAN', 
        'KODE_REFERRAL'
    ];
}
