<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class DataPenggunaSeeder extends Seeder
{
    public function run()
    {
        DB::table('data_pengguna')->insert([
            [
                'id' => '1',
                'nama_pengguna' => 'Admin1',
                'alamat_pengguna' => 'Jl. Mawar No. 1',
                'noHP_pengguna' => '081234567891',
                'id_role' => 1
            ],
            [
                'id' => '2',
                'nama_pengguna' => 'Admin2',
                'alamat_pengguna' => 'Jl. Melati No. 2',
                'noHP_pengguna' => '082345678902',
                'id_role' => 2
            ],
            [
                'id' => '3',
                'nama_pengguna' => 'Admin3',
                'alamat_pengguna' => 'Jl. Anggrek No. 3',
                'noHP_pengguna' => '083456789013',
                'id_role' => 1
            ],
            [
                'id' => '4',
                'nama_pengguna' => 'Admin4',
                'alamat_pengguna' => 'Jl. Sakura No. 4',
                'noHP_pengguna' => '084567890124',
                'id_role' => 2
            ],
            [
                'id' => '5',
                'nama_pengguna' => 'Admin5',
                'alamat_pengguna' => 'Jl. Mawar No. 5',
                'noHP_pengguna' => '085678901235',
                'id_role' => 1
            ],
        ]);
    }
}
