<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\Kemahasiswaan;
use App\Models\LPJKegiatan;
use App\Models\Ormawa;
use App\Models\Pembina;
use App\Models\PengajuanLegalitas;

Class BerandaKemahasiswaanService {
    public function getKemahasiswaanByUserId($userId)
    {
        return Kemahasiswaan::where('id_pengguna', $userId)->first();
    }
    public function getCounts()
    {
        $data = [];
        
        // Menghitung jumlah data yang dibutuhkan
        $data['daftar_pengajuan_legalitas'] = PengajuanLegalitas::count();
        $data['daftar_proposal_kegiatan'] = PengajuanLegalitas::count();
        $data['daftar_lpj_kegiatan'] = LPJKegiatan::count();
        $data['daftar_ormawa'] = Ormawa::count();
        $data['daftar_pembina'] = Pembina::count();

        return $data;
    }
}
    