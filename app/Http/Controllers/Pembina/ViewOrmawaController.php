<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Pembina\ViewOrmawaService;


class ViewOrmawaController extends Controller
{
    private $viewOrmawaService;

    public function __construct(ViewOrmawaService $viewOrmawaService)
    {
        $this->viewOrmawaService = $viewOrmawaService;
    }
    public function index()
    {

        $ormawas = $this->viewOrmawaService->index();
        // dd($ormawas);

        // Tampilkan view dan pass data
        return view('Pembina.ViewOrmawa.index', $ormawas);
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
