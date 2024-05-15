<?php

namespace App\Http\Controllers\Ormawa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Ormawa\PengajuanLPJKegiatan;


class LPJKegiatanController extends Controller
{
    private $pengajuanLPJKegiatan;

    public function __construct(PengajuanLPJKegiatan $pengajuanLPJKegiatan)
    {
        $this->pengajuanLPJKegiatan = $pengajuanLPJKegiatan;
    }

    public function index()
    {
    return $this->pengajuanLPJKegiatan->index();
    }

    public function unggah($id)
    {
    return $this->pengajuanLPJKegiatan->unggah($id);
    }

    public function menunggu()
    {
    return $this->pengajuanLPJKegiatan->menunggu();
    }

    public function listRevisi()
    {
    return $this->pengajuanLPJKegiatan->listRevisi();
    }

    public function Revisi()
    {
    return $this->pengajuanLPJKegiatan->Revisi();
    }
    public function store(Request $request)
    {
        return $this->pengajuanLPJKegiatan->store($request);  
    }
}
