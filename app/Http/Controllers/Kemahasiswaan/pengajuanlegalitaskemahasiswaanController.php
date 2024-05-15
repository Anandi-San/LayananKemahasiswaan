<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\PengajuanlegalitasService;
use Illuminate\Http\Request;

class pengajuanlegalitaskemahasiswaanController extends Controller
{
    protected $pengajuanlegalitasService;

    public function __construct(pengajuanlegalitasService $pengajuanlegalitasService)
    {
        $this->pengajuanlegalitasService = $pengajuanlegalitasService;
    }

    public function index()
    {
        $data = $this->pengajuanlegalitasService->index();
    
        // Kirim data ke view dengan compact
        return view('Kemahasiswaan.pengajuanLegalitas.index', compact('data'));
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
