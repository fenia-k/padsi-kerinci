<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LoyaltyProgramSeeder extends Seeder
{
    public function run()
    {
        DB::table('loyalty_program')->insert([
            [
                'kode_referal' => 'LOYAL123',
                'batas_loyalty' => 10,
                'diskon' => 15,
                'id_pelanggan' => 1
            ],
            [
                'kode_referal' => 'LOYAL456',
                'batas_loyalty' => 5,
                'diskon' => 10,
                'id_pelanggan' => 2
            ],
            [
                'kode_referal' => 'LOYAL789',
                'batas_loyalty' => 8,
                'diskon' => 12,
                'id_pelanggan' => 3
            ],
        ]);
    }
}
