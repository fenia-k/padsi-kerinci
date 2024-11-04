<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Buat akun owner
        User::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('password'), // ganti dengan password yang aman
            'role' => 'owner',
        ]);

        // Buat akun pegawai
        User::create([
            'name' => 'Pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => Hash::make('password'), // ganti dengan password yang aman
            'role' => 'pegawai',
        ]);
    }
}
