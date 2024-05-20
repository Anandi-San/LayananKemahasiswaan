<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SuperAdmin;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Superadmin::create([
            'nama_superAdmin' => 'Super Admin',
            'id_pengguna' => 2,
            'status' => 'Aktif',
        ]);
    }
}
