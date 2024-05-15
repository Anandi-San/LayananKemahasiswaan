<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\SKlegalitasService;
use Illuminate\Http\Request;

class skLegalitaskemahasiswaanController extends Controller
{
    protected $sklegalitasService;
    
    public function __construct(SklegalitasService $sklegalitasService)
    {
        $this->sklegalitasService = $sklegalitasService;
    }

    public function index()
    {
        $skLegalitas = $this->sklegalitasService->index();
        
        return view('Kemahasiswaan.skLegalitas.index', compact('skLegalitas'));
    }

    public function create()
    {
        $data = $this->sklegalitasService->create();

        // Pastikan data adalah array
        if (!is_array($data)) {
            $data = [];
        }
    
        return view('Kemahasiswaan.skLegalitas.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->sklegalitasService->store($request);
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
