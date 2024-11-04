<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        DB::table('menu')->insert([
            [
                'nama_menu' => 'Nasi Goreng',
                'harga_menu' => 25000,
                'deskripsi_menu' => 'Nasi goreng dengan bumbu spesial'
            ],
            [
                'nama_menu' => 'Mie Goreng',
                'harga_menu' => 20000,
                'deskripsi_menu' => 'Mie goreng pedas'
            ],
            [
                'nama_menu' => 'Ayam Bakar',
                'harga_menu' => 30000,
                'deskripsi_menu' => 'Ayam bakar dengan sambal terasi'
            ],
            [
                'nama_menu' => 'Sate Ayam',
                'harga_menu' => 15000,
                'deskripsi_menu' => 'Sate ayam dengan bumbu kacang'
            ],
            [
                'nama_menu' => 'Es Teh Manis',
                'harga_menu' => 5000,
                'deskripsi_menu' => 'Teh manis dingin'
            ],
        ]);
    }
}
