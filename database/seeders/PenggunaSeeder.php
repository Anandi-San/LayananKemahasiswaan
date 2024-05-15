<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        // Pengguna::create([
        //     'email' => 'ormawa@itk.ac.id',
        //     'password' => bcrypt('12345678'),
        //     'role' => ('Ormawa')
        // ]);

        // Pengguna::create([
        //     'email' => 'ormawa2@itk.ac.id',
        //     'password' => bcrypt('12345678'),
        //     'role' => ('Ormawa')
        // ]);

        // Pengguna::create([
        //     'email' => 'pembinan@lecturer.itk.ac.id',
        //     'password' => bcrypt('12345678'),
        //     'role' => ('Pembina')
        // ]);

        // Pengguna::create([
        //     'email' => 'kemahasiswaan@itk.ac.id',
        //     'password' => bcrypt('12345678'),
        //     'role' => ('Kemahasiswaan')
        // ]);

        // Pengguna::create([
        //     'email' => 'superadmin@admin.com',
        //     'password' => bcrypt('12345678'),
        //     'role' => ('SuperAdmin')
        // ]);
        Pengguna::create([
            'email' => 'pembina2@lecturer.itk.ac.id',
            'password' => bcrypt('12345678'),
            'role' => ('Pembina')
        ]);
    }
}
