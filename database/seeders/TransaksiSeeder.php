<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        DB::table('transaksi')->insert([
            [
                'total_harga' => 50000,
                'nominal' => 60000,
                'tanggal_transaksi' => Carbon::now()->subDays(5),
                'id_pelanggan' => 1,
                'id_pengguna' => 1
            ],
            [
                'total_harga' => 30000,
                'nominal' => 30000,
                'tanggal_transaksi' => Carbon::now()->subDays(4),
                'id_pelanggan' => 2,
                'id_pengguna' => 2
            ],
            [
                'total_harga' => 45000,
                'nominal' => 50000,
                'tanggal_transaksi' => Carbon::now()->subDays(3),
                'id_pelanggan' => 3,
                'id_pengguna' => 1
            ],
            [
                'total_harga' => 25000,
                'nominal' => 30000,
                'tanggal_transaksi' => Carbon::now()->subDays(2),
                'id_pelanggan' => 4,
                'id_pengguna' => 2
            ],
            [
                'total_harga' => 40000,
                'nominal' => 45000,
                'tanggal_transaksi' => Carbon::now()->subDay(),
                'id_pelanggan' => 5,
                'id_pengguna' => 1
            ],
        ]);
    }
}
