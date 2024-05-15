<?php

namespace App\Http\Controllers\Ormawa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\OrmawaService;

class OrmawaController extends Controller
{
    protected $ormawaService;

    public function __construct(OrmawaService $ormawaService)
    {
        $this->ormawaService = $ormawaService;
    }

    public function index()
    {
        $userId = Auth::id();
        $ormawa = $this->ormawaService->getOrmawaDataByUserId($userId);
        $pengajuanLegalitasDuration = null;
        if ($ormawa['pengajuan_legalitas']) {
            $pengajuanLegalitasDuration = $this->ormawaService->calculateDuration($ormawa['pengajuan_legalitas']->created_at, now());
        }

        $proposalKegiatanDuration = [];
        foreach ($ormawa['proposal_kegiatan'] as $proposal) {
            $proposalKegiatanDuration[$proposal->id] = $this->ormawaService->calculateDuration($proposal->created_at, now());
        }

        // Lakukan sesuatu dengan $proposalKegiatanDuration
        $lpjKegiatanDuration = [];
        foreach ($ormawa['lpj_kegiatan'] as $lpj) {
    // Pastikan LPJ kegiatan tidak null dan memiliki properti id_proposal_kegiatan
            if ($lpj && $lpj->id_proposal_kegiatan) {
                $lpjKegiatanDuration[$lpj->id_proposal_kegiatan] = $this->ormawaService->calculateDuration($lpj->created_at, now());
            }
        }

        return view('Ormawa.index', compact('ormawa', 'pengajuanLegalitasDuration', 'proposalKegiatanDuration', 'lpjKegiatanDuration'));
    }
}