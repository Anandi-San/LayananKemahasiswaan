<?php

namespace App\Http\Services\Kemahasiswaan;

use Illuminate\Http\Request;

class LaporanAkhirService {
public function index()
    {
        $data = [
            'content' => 'Kemasiswaan/LaporanAkhir/index',
        ];
        return view('Kemasiswaan/laporanakhir/index', $data);
    }
}