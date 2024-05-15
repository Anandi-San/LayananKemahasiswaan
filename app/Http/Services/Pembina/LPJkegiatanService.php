<?php

namespace App\Http\Services\Pembina;

use App\Models\Pembina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LPJkegiatanService {

public function index()
{
    $user = Auth::user();
    
    // Temukan Pembina yang terkait dengan pengguna yang login
    $pembina = Pembina::where('id_pengguna', $user->id)->first();
    
    // Ambil daftar OrmawaPembina yang terkait dengan Pembina
    $ormawaPembinaList = $pembina->ormawaPembina;

    // Array untuk menampung data lpjKegiatan
    $lpjKegiatanData = [];

    // Iterasi melalui OrmawaPembina yang terkait dengan Pembina
    foreach ($ormawaPembinaList as $ormawaPembina) {
        // Dapatkan daftar pengajuan legalitas terkait OrmawaPembina
        $pengajuanLegalitasList = $ormawaPembina->pengajuanLegalitas;

        // Loop melalui daftar pengajuan legalitas
        foreach ($pengajuanLegalitasList as $pengajuanLegalitas) {
            // Ambil SK Legalitas terkait pengajuan legalitas
            $skLegalitas = $pengajuanLegalitas->skLegalitas;
            
            // Periksa apakah `skLegalitas` memiliki relasi `proposalKegiatan`
            if ($skLegalitas) {
                    // Dapatkan koleksi `proposalKegiatan` terkait dengan `skLegalitas`
                    $proposalKegiatanCollection = $skLegalitas->proposalKegiatan;

                    // Periksa apakah koleksi `proposalKegiatan` ada dan tidak kosong
                    if ($proposalKegiatanCollection->isNotEmpty()) {
                        // Ambil model `Proposal_Kegiatan` pertama dari koleksi
                        $proposalKegiatan = $proposalKegiatanCollection->first();

                        // `dd` untuk memeriksa apakah mendapatkan model `Proposal_Kegiatan` pertama dengan benar
                        // dd($proposalKegiatan);
                    }
                }


                // Pastikan koleksi `proposalKegiatan` ada
                if ($proposalKegiatanCollection) {
                    // Loop melalui koleksi proposalKegiatan
                    foreach ($proposalKegiatanCollection as $proposalKegiatan) {
                        // Akses relasi `lpjKegiatan` dari model `ProposalKegiatan`
                        $lpjKegiatan = $proposalKegiatan->lpjKegiatan;
                        // dd($lpjKegiatan);

                        // Pastikan `lpjKegiatan` ada
                        if ($lpjKegiatan) {
                            // Konversi model `LPJKegiatan` menjadi array dan tambahkan ke `lpjKegiatanData`
                            $lpjKegiatanData[] = $lpjKegiatan;
                        }
                        // dd($lpjKegiatanData);
                    }
                }
            }
        }

    // Kembalikan data `lpjKegiatan` dalam bentuk array biasa
    return $lpjKegiatanData;
}


    public function Revisi()
    {
        $data = [
            'content' => 'ormawa/LPJKegiatan/Revisi',
        ];
        return view('Ormawa/LpjKegiatan/Revisi', $data);
    }
}
