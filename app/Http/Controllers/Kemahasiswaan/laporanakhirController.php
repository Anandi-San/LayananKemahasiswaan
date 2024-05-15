<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\LaporanAkhirService;
use Illuminate\Http\Request;

class laporanakhirController extends Controller
{
    protected $laporanakhirService;

    public function __construct(laporanAkhirService $laporanakhirService)
    {
        $this->laporanakhirService = $laporanakhirService;
    }
    public function index()
    {
        $laporanakhir = $this->laporanakhirService->index();
        
        return view('Kemahasiswaan.laporanAkhir.index', compact('laporanakhir'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
