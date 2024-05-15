<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\Proposal_Kegiatan;
use Illuminate\Http\Request;

class ProposalKegiatanService {
    public function index()
{
    // Gunakan eager loading untuk memuat relasi hingga ormawa
    $proposal_kegiatan = Proposal_Kegiatan::with('skLegalitas.pengajuanLegalitas.ormawaPembina.ormawa')->get();
    return $proposal_kegiatan;
}
}