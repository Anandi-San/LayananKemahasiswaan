<?php

namespace App\Http\Controllers\Ormawa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Ormawa\UnggahLegalitas;

class PengajuanLegalitasController extends Controller
{
    private $unggahLegalitas;

    public function __construct(UnggahLegalitas $unggahLegalitas)
    {
        $this->unggahLegalitas = $unggahLegalitas;
    }

    public function index()
    {
    return $this->unggahLegalitas->index();
    }

    public function waitRevision()
    {
    return $this->unggahLegalitas->waitRevision();
    }

    public function listRevisi()
    {
    return $this->unggahLegalitas->listRevisi();
    }

    public function revision()
    {
    return $this->unggahLegalitas->revision();
    }

    public function store(Request $request)
    {
        return $this->unggahLegalitas->store($request);  
        // return redirect()->back()->with('success', 'Data berhasil disimpan ke dalam database.');

        // $unggahLegalitasService = new UnggahLegalitas();
        // $unggahLegalitasService->store($request, $someStep);
    }
    public function update(Request $request)
    {
        return $this->unggahLegalitas->update($request);  
    }
}
