<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DataPelanggan; // Pastikan model DataPelanggan ada dan terhubung ke tabel yang benar
use Illuminate\Support\Facades\DB;

class DataPelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tambahkan data dummy untuk data pelanggan
        DB::table('data_pelanggan')->insert([
            [
                'id' => 1,
                'nama_pelanggan' => 'Ahmad Zaki',
                'alamat_pelanggan' => 'Jl. Kebon Jeruk No.12, Jakarta',
                'noHP_pelanggan' => '081234567890'
            ],
            [
                'id' => 2,
                'nama_pelanggan' => 'Dewi Kartika',
                'alamat_pelanggan' => 'Jl. Merpati No.5, Bandung',
                'noHP_pelanggan' => '081298765432'
            ],
            [
                'id' => 3,
                'nama_pelanggan' => 'Siti Rahmawati',
                'alamat_pelanggan' => 'Jl. Anggrek No.2, Surabaya',
                'noHP_pelanggan' => '082134567890'
            ],
            [
                'id' => 4,
                'nama_pelanggan' => 'Budi Santoso',
                'alamat_pelanggan' => 'Jl. Pahlawan No.6, Yogyakarta',
                'noHP_pelanggan' => '083245678910'
            ],
            [
                'id' => 5,
                'nama_pelanggan' => 'Indra Wijaya',
                'alamat_pelanggan' => 'Jl. Mangga No.3, Medan',
                'noHP_pelanggan' => '084356789123'
            ]
        ]);
    }
}
