<?php

namespace App\Http\Services\Pembina;

use App\Models\KeteranganPembayaran;
use App\Models\MonitoringKegiatan;
use App\Models\Ormawa;
use App\Models\OrmawaPembina;
use App\Models\Pembina;
use App\Models\Proposal_Kegiatan;
use Illuminate\Support\Facades\Auth;

class PembinaService
{

    public function index()
    {
        // Langkah 1: Ambil ID pengguna yang sedang login
        $userId = Auth::user()->id;

        // Langkah 2: Ambil ID pembina berdasarkan ID pengguna
        $pembinaId = $this->getPembinaByUserId($userId)->id;

        // Langkah 3: Ambil ID Ormawa dari tabel pivot OrmawaPembina berdasarkan ID pembina
        $ormawaIds = OrmawaPembina::where('id_pembina', $pembinaId)
            ->pluck('id_ormawa')
            ->toArray();

        // Langkah 4: Ambil data Ormawa dari tabel tbl_ormawa berdasarkan ID Ormawa
        $ormawas = Ormawa::whereIn('id', $ormawaIds)->get();

        // Langkah 5: Ambil data Pengurus Ormawa dari tabel tbl_pengurus_ormawa berdasarkan ID Ormawa

        // Langkah 6: Ambil data Proposal Kegiatan dari tabel tbl_proposal_kegiatan berdasarkan ID Ormawa
        $proposalKegiatans = Proposal_Kegiatan::whereHas('skLegalitas.pengajuanLegalitas.ormawaPembina', function ($query) use ($ormawaIds) {
            $query->whereIn('id_ormawa', $ormawaIds);
        })
            ->with(['skLegalitas.pengajuanLegalitas.ormawaPembina', 'skLegalitas.pengajuanLegalitas', 'skLegalitas'])
            ->get();

        // Langkah 7: Ambil data Monitoring Kegiatan berdasarkan ID Proposal Kegiatan
        $monitoringKegiatans = MonitoringKegiatan::whereIn('id_proposal_kegiatan', $proposalKegiatans->pluck('id'))->get();

        // Langkah 8: Ambil data Keterangan Pembayaran berdasarkan ID Monitoring Kegiatan
        $keteranganPembayarans = KeteranganPembayaran::whereIn('id_monitoring_kegiatan', $monitoringKegiatans->pluck('id'))->get();

        // Gabungkan data Ormawa, Pengurus Ormawa, Proposal Kegiatan, Monitoring Kegiatan, dan Keterangan Pembayaran
        $data = [];
        foreach ($ormawas as $ormawa) {
            $data[] = [
                'proposal_kegiatan' => $proposalKegiatans,
                'monitoring_kegiatan' => $monitoringKegiatans->where('id_ormawa', $ormawa->id),
                'keterangan_pembayaran' => $keteranganPembayarans->whereIn('id_monitoring_kegiatan', $monitoringKegiatans->where('id_ormawa', $ormawa->id)->pluck('id')),
            ];
            // dd($data);
        }


        return view('Pembina.index', compact('data'));
    }
    public function getPembinaByUserId($userId)
    {
        return Pembina::where('id_pengguna', $userId)->first();
    }

    public function getProposalKegiatan($idProposalKegiatan)
    {
        return Proposal_Kegiatan::with('monitoringKegiatan.keteranganPembayaran')->find($idProposalKegiatan);
    }
}
