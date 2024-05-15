<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Pembina\ProposalKegiatanService;

class ProposalKegiatanController extends Controller
{
    private $proposalKegiatanService;

    public function __construct(ProposalKegiatanService $proposalKegiatanService)
    {
        $this->proposalKegiatanService = $proposalKegiatanService;
    }
    public function index()
{
    // Panggil metode `index` dari `proposalKegiatanService` dan dapatkan data yang dibutuhkan
    $proposalKegiatanData = $this->proposalKegiatanService->index();
    // dd($proposalKegiatanData);
    
    return view('Pembina.ProposalKegiatan.index', compact('proposalKegiatanData'));
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
