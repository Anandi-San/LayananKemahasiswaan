<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\OrmawaService;
use Illuminate\Http\Request;

class ormawakemahasiswaanController extends Controller
{
    protected $ormawaService;
    
    public function __construct(ormawaService $ormawaService)
    {
        $this->ormawaService = $ormawaService;
    }
    public function index()
    {
        $ormawaList = $this->ormawaService->index();
        
        return view('Kemahasiswaan.ormawa.index', compact('ormawaList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->ormawaService->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->ormawaService->store($request);
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
        return $this->ormawaService->edit($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->ormawaService->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->ormawaService->destroy($id);
    }
}
