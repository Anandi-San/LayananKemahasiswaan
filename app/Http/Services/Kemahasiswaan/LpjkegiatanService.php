<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\LPJKegiatan;
use Illuminate\Http\Request;

class LpjkegiatanService {


    public function index()
    {
        // Query data with relationships
        $lpjkegiatan = LPJKegiatan::with('proposalKegiatan.SKlegalitas.pengajuanLegalitas.ormawaPembina.ormawa')->get();
        return $lpjkegiatan;
    }
    
}