<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\ProposalKegiatanService;
use Illuminate\Http\Request;

class proposalkegiatankemahasiswaanController extends Controller
{
    protected $proposalkegiatanService;
    
    public function __construct(ProposalKegiatanService $proposalkegiatanService)
    {
    $this->proposalkegiatanService = $proposalkegiatanService;
    }

    public function index()
    {
        $proposal_kegiatan = $this->proposalkegiatanService->index();
        // dd($data);
        
        return view('Kemahasiswaan.proposalKegiatan.index', compact('proposal_kegiatan'));
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
