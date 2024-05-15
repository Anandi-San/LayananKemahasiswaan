<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pembina;


class PembinaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pembina::create([
            'id_pengguna' => 7,
            'nama_pembina' => 'Nandi saputra',
            'photo_pembina' => 'Pembina',
        ]);
    }
}
