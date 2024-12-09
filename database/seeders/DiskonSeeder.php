<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        DB::table('diskon')->truncate(); // Menghapus data lama jika ada

        DB::table('diskon')->insert([
            [
                'harga_diskon' => 10000,
                'batas_pemakaian' => 5,
                'id' => '1',
                'id_pelanggan' => 1, // Pastikan ini sesuai dengan id_pelanggan yang ada di tabel pelanggan
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'harga_diskon' => 5000,
                'batas_pemakaian' => 10,
                'id' => '2',
                'id_pelanggan' => 2, // Pastikan ini sesuai dengan id_pelanggan yang ada di tabel pelanggan
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
