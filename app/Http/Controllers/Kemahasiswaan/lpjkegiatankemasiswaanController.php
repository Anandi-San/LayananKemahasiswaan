<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\LpjkegiatanService;
use Illuminate\Http\Request;

class lpjkegiatankemasiswaanController extends Controller
{
    protected $lpjkegiatanService;
    
    public function __construct(lpjkegiatanService $lpjkegiatanService)
    {
        $this->lpjkegiatanService = $lpjkegiatanService;
    }
    public function index()
    {
        $lpjkegiatan = $this->lpjkegiatanService->index();
        return view('Kemahasiswaan.lpjKegiatan.index', compact('lpjkegiatan'));
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
