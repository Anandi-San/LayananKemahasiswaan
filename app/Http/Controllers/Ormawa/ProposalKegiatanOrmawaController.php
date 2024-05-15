<?php

namespace App\Http\Controllers\Ormawa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Ormawa\ProposalKegiatan;

class ProposalKegiatanOrmawaController extends Controller
{
    private $proposalKegiatan;

    public function __construct(ProposalKegiatan $proposalKegiatan)
    {
        $this->proposalKegiatan = $proposalKegiatan;
    }

    public function index()
    {
        return $this->proposalKegiatan->index();
    }

    public function unggah()
    {
        return $this->proposalKegiatan->unggah();
    }

    public function menunggu()
    {
    return $this->proposalKegiatan->menunggu();
    }

    public function listRevisi()
    {
    return $this->proposalKegiatan->listRevisi();
    }

    public function Revisi()
    {
    return $this->proposalKegiatan->Revisi();
    }

    public function store(Request $request)
    {
    return $this->proposalKegiatan->store($request);
    }
}
