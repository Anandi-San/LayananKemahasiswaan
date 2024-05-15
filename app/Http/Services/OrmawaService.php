<?php

namespace App\Http\Services;

use App\Models\LPJKegiatan;
use App\Models\Pengguna;
use App\Models\Ormawa;
use App\Models\OrmawaPembina;
use App\Models\PengajuanLegalitas;
use App\Models\Proposal_Kegiatan;
use App\Models\SKlegalitas;
use Illuminate\Support\Facades\DB;

class OrmawaService
{
    public function getOrmawaDataByUserId($userId)
    {
        // Menggunakan transaksi untuk menjaga konsistensi data
        return DB::transaction(function () use ($userId) {
            // Mengambil data pengguna
            $pengguna = Pengguna::findOrFail($userId);

            // Mengambil data ormawa berdasarkan pengguna
            $ormawa = Ormawa::where('id_pengguna', $userId)->first();
            // dd($ormawa);

            // Mengambil data pembina ormawa
            $pembinaOrmawa = OrmawaPembina::where('id_ormawa', $ormawa->id)->first();
            // dd($pembinaOrmawa);

            // Mengambil data pengajuan legalitas terbaru
            $pengajuanLegalitas = PengajuanLegalitas::where('id_ormawa_pembina', $ormawa->id)
                ->latest()
                ->first();

            // Mengambil data SK legalitas terbaru jika ada pengajuan legalitas yang ditemukan
            $skLegalitas = null;
            if ($pengajuanLegalitas) {
                $skLegalitas = SKlegalitas::where('id_pengajuan_legalitas', $pengajuanLegalitas->id)
                    ->latest()
                    ->first();
            }
                // dd($skLegalitas);

            // Mengambil data proposal kegiatan terbaru
           // Mengambil data proposal kegiatan terbaru
            $proposalKegiatan = Proposal_Kegiatan::where('id_SK_legalitas', $skLegalitas->id)
            ->latest()
            ->get();
 
            // Mengambil data LPJ kegiatan terbaru
            $lpjKegiatan = collect();
            foreach ($proposalKegiatan as $proposal) {
            $lpj = LPJKegiatan::where('id_proposal_kegiatan', $proposal->id)
                ->latest()
                ->first();
            $lpjKegiatan->push($lpj);
            }

                // dd($lpjKegiatan);

            return [
                'pengguna' => $pengguna,
                'ormawa' => $ormawa,
                'pembina_ormawa' => $pembinaOrmawa,
                'pengajuan_legalitas' => $pengajuanLegalitas,
                'sk_legalitas' => $skLegalitas,
                'proposal_kegiatan' => $proposalKegiatan,
                'lpj_kegiatan' => $lpjKegiatan,
            ];
        });
    }
    public function calculateDuration($startDate, $endDate)
    {
        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);
        
        return $end->diffInDays($start);
    }

}
