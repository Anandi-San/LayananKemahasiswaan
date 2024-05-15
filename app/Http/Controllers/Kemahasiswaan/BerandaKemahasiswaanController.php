<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Kemahasiswaan\BerandaKemahasiswaanService;
use Illuminate\Support\Facades\Auth;


class BerandaKemahasiswaanController extends Controller
{
    protected $berandakemahasiswaanService;

    public function __construct(berandaKemahasiswaanService $berandaKemahasiswaanService)
    {
        $this->berandakemahasiswaanService = $berandaKemahasiswaanService;
    }

    public function index()
    {
        
        $dataCounts = $this->berandakemahasiswaanService->getCounts();

        return view('Kemahasiswaan.index', ['dataCounts' => $dataCounts]);
    }
}