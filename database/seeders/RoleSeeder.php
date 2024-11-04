<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan untuk hanya memasukkan data jika belum ada
        if (DB::table('role')->count() == 0) {
            DB::table('role')->insert([
                [
                    'id' => '1', // ID untuk owner
                    'nama_role' => 'Owner',

                ],
                [
                    'id' => '2', // ID untuk pegawai
                    'nama_role' => 'Pegawai',
                ],
            ]);
        }
    }
}
