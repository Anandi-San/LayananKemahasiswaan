<?php

namespace App\Http\Controllers\Ormawa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Ormawa\SkLegalitasService;


class SkLegalitasController extends Controller
{
    private $skLegalitasService;

    public function __construct(SkLegalitasService $skLegalitasService)
    {
        $this->skLegalitasService = $skLegalitasService;
    }

    public function index()
    {
    return $this->skLegalitasService->index();
    }

    public function download()
    {
    return $this->skLegalitasService->download();
    }
}
