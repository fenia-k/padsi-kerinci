<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            DataPelangganSeeder::class,
            DataPenggunaSeeder::class,
            DiskonSeeder::class,
            LaporanSeeder::class,
            LoyaltyProgramSeeder::class,
            MenuSeeder::class,
            // RoleSeeder::class,
            StokSeeder::class,
            TransaksiSeeder::class,
        ]);
    }
}
