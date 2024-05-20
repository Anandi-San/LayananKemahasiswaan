<?php

namespace App\Http\Services\Pembina;

use App\Models\MonitoringKegiatan;
use App\Models\Pembina;
use App\Models\PengurusOrmawa;
use App\Models\Proposal_Kegiatan;
use Illuminate\Http\Request;
use App\Models\Ormawa;
use App\Models\OrmawaPembina;
use Illuminate\Support\Facades\Auth;

class ViewOrmawaService {

    public function index()
{
    // Langkah 1: Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Langkah 2: Ambil ID pembina berdasarkan ID pengguna
    $pembinaId = Pembina::where('id_pengguna', $userId)->value('id');

    // Langkah 3: Ambil ID Ormawa dari tabel pivot OrmawaPembina berdasarkan ID pembina
    $ormawaIds = OrmawaPembina::where('id_pembina', $pembinaId)
        ->pluck('id_ormawa')
        ->toArray();

    // Langkah 4: Ambil data Ormawa dari tabel tbl_ormawa berdasarkan ID Ormawa
    $ormawas = Ormawa::whereIn('id', $ormawaIds)->get();

    // Langkah 5: Ambil data Pengurus Ormawa dari tabel tbl_pengurus_ormawa berdasarkan ID Ormawa
    $pengurusOrmawas = PengurusOrmawa::whereIn('id_ormawa', $ormawaIds)->get();

    // Langkah 6: Ambil data Proposal Kegiatan dari tabel tbl_proposal_kegiatan berdasarkan ID Ormawa
    $proposalKegiatans = Proposal_Kegiatan::whereHas('skLegalitas.pengajuanLegalitas.ormawaPembina', function ($query) use ($ormawaIds) {
        $query->whereIn('id_ormawa', $ormawaIds);
    })
    ->with(['skLegalitas.pengajuanLegalitas.ormawaPembina', 'skLegalitas.pengajuanLegalitas', 'skLegalitas'])
    ->get();
    // dd($proposalKegiatans);

    // Langkah 7: Ambil data Monitoring Kegiatan berdasarkan ID Proposal Kegiatan
    $monitoringKegiatans = MonitoringKegiatan::whereIn('id_proposal_kegiatan', $proposalKegiatans->pluck('id'))->get();
    // dd($monitoringKegiatans);

    // Gabungkan data Ormawa, Pengurus Ormawa, dan Monitoring Kegiatan
    $ormawaData = [];
    foreach ($ormawas as $ormawa) {
        $ormawaData[] = [
            'ormawa' => $ormawa,
            'pengurus' => $pengurusOrmawas->where('id_ormawa', $ormawa->id)->first(),
            // 'proposal_kegiatan' => $proposalKegiatans,
            'monitoring_kegiatan' => $monitoringKegiatans,
        ];
        // dd($ormawaData);
    }

    // Kembalikan data Ormawa, Pengurus Ormawa, Proposal Kegiatan, dan Monitoring Kegiatan
    return [
        'ormawaData' => $ormawaData,
    ];
}

    public function store()
    {
        $data = [
            'content' => 'ormawa/ViewOrmawa/store',
        ];
        return view('Ormawa/ViewOrmawa/store', $data);
    }
}
