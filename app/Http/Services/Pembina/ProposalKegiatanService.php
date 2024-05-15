<?php

namespace App\Http\Services\Pembina;

use App\Models\Pembina;
use App\Models\Proposal_Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalKegiatanService {

public function index() {
    // Ambil pengguna yang sedang login
    $user = Auth::user();
    
    // Temukan Pembina yang terkait dengan pengguna yang login
    $pembina = Pembina::where('id_pengguna', $user->id)->first();
    
    // Ambil daftar OrmawaPembina yang terkait dengan Pembina
    $ormawaPembinaList = $pembina->ormawaPembina;

    // Array untuk menampung data Proposal_Kegiatan
    // $proposalKegiatanData = [];

    // Iterasi melalui OrmawaPembina yang terkait dengan Pembina
    foreach ($ormawaPembinaList as $ormawaPembina) {
        // Dapatkan daftar pengajuan legalitas terkait OrmawaPembina
        $pengajuanLegalitasList = $ormawaPembina->pengajuanLegalitas;

        // Loop melalui daftar pengajuan legalitas
        foreach ($pengajuanLegalitasList as $pengajuanLegalitas) {
            // Ambil SK Legalitas terkait pengajuan legalitas
            $skLegalitas = $pengajuanLegalitas->skLegalitas;
            // dd($skLegalitas);
            
            // Periksa apakah `skLegalitas` memiliki relasi `proposalKegiatan`
            if ($skLegalitas) {
                $proposalKegiatan = $skLegalitas->proposalKegiatan;
                // dd($proposalKegiatan);

                // dd($proposalKegiatanData);
            }
        }
    }

    // Kembalikan data Proposal Kegiatan
    return $proposalKegiatan;
}


    

    


    public function Revisi()
    {
        $data = [
            'content' => 'ormawa/proposalKegiatan/Revisi',
        ];
        return view('Ormawa/ProposalKegiatan/Revisi', $data);
    }
}
