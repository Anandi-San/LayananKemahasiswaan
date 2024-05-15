<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kemahasiswaan;


class KemahasiswaanSeeders extends Seeder
{
    public function run(): void
    {
        Kemahasiswaan::create([
            'id_pengguna' => 4,
            'id_superadmin' => 0,
            'ketua_kemahasiswaan' => 'nasai',
            'status' => 'Aktif',
            'logo_kemahasiswaan' => 'Panti',
        ]);
    }
}
