<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class StokSeeder extends Seeder
{
    public function run()
    {
        DB::table('stok')->insert([
            [
                'nama_stok' => 'Gula',
                'jumlah_stok' => 100
            ],
            [
                'nama_stok' => 'Tepung Terigu',
                'jumlah_stok' => 50
            ],
            [
                'nama_stok' => 'Minyak Goreng',
                'jumlah_stok' => 75
            ],
            [
                'nama_stok' => 'Beras',
                'jumlah_stok' => 200
            ],
            [
                'nama_stok' => 'Garam',
                'jumlah_stok' => 60
            ],
        ]);
    }
}
