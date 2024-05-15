<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\PembinaService;
use Illuminate\Http\Request;

class pembinakemahasiswaanController extends Controller
{
    protected $pembinaService;

    public function __construct(pembinaService $pembinaService)
    {
        $this->pembinaService = $pembinaService;
    }

    public function index()
    {
        $pembinaList = $this->pembinaService->index();
        
        return view('Kemahasiswaan.pembina.index', compact('pembinaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->pembinaService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return  $this->pembinaService->store($request);
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
        return $this->pembinaService->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->pembinaService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->pembinaService->destroy($id);
    }
}
