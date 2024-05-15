<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call each seeder
        $this->call(PenggunaSeeder::class);
        // $this->call(OrmawaSeeder::class);
        $this->call(PembinaSeeder::class);
        // $this->call(KemahasiswaanSeeders::class);
        // $this->call(SuperAdminSeeder::class);
    }
}
