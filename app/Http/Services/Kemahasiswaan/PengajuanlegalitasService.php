<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\PengajuanLegalitas;
use Illuminate\Http\Request;

class PengajuanlegalitasService {
    public function index()
    {
    $pengajuanLegalitasList = PengajuanLegalitas::with('ormawaPembina.ormawa')->get();
    // dd($pengajuanLegalitasList);

    return $pengajuanLegalitasList;
    }
}