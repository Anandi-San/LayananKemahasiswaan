<?php

namespace App\Http\Services\Pembina;

use Illuminate\Http\Request;
use App\Models\SKlegalitas;
use Illuminate\Support\Facades\Auth;

class SKLegalitasService {

    public function index()
    {
        $pembina = Auth::user()->pembina->first();
        $ormawaPembinaList = $pembina->ormawaPembina;
        // dd($ormawaPembinaList);
        // Array untuk menyimpan data SK Legalitas yang sesuai dengan Pembina yang sedang login
        $skLegalitasData = [];

        // Loop melalui setiap Ormawa yang dibina oleh Pembina
        foreach ($ormawaPembinaList as $ormawaPembina) {
            // Dapatkan daftar pengajuan legalitas terkait OrmawaPembina
            $pengajuanLegalitasList = $ormawaPembina->pengajuanLegalitas;
            // dd($pengajuanLegalitasList);

            // Loop melalui pengajuan legalitas untuk mendapatkan SK Legalitas
            foreach ($pengajuanLegalitasList as $pengajuanLegalitas) {
                $skLegalitas = $pengajuanLegalitas->skLegalitas;
                // dd($skLegalitas);


                // Simpan data yang relevan jika SK Legalitas tersedia
                if ($skLegalitas) {
                    $skLegalitasData[] = [
                        'nama_ormawa' => $ormawaPembina->ormawa->nama_ormawa,
                        'nomor_sk' => $skLegalitas->nomor_SK,
                        'tanggal_terbit' => $skLegalitas->tanggal_terbit,
                        'tanggal_berlaku_mulai' => $skLegalitas->tanggal_berlaku_mulai,
                        'tanggal_berlaku_selesai' => $skLegalitas->tanggal_berlaku_selesai,
                        'file_sk' => $skLegalitas->file_SK,
                        'status' => $skLegalitas->status,
                        // Tambahkan kolom lain sesuai kebutuhan
                    ];
                }
                // dd($skLegalitasData);
            }
            // dd($skLegalitasData);
        }

        // Return data yang dapat ditampilkan pada view
        return view('Pembina/SKLegalitas/index', ['skLegalitasData' => $skLegalitasData]);

    }

    public function store()
    {
        $data = [
            'content' => 'ormawa/proposalKegiatan/store',
        ];
        return view('Ormawa/ProposalKegiatan/store', $data);
    }
}
