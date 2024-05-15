<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\PembinaService;
use Illuminate\Support\Facades\Auth;


class BerandaPembinaController extends Controller
{
    protected $pembinaService;

    public function __construct(pembinaService $pembinaService)
    {
        $this->pembinaService = $pembinaService;
    }

    public function index()
    {
        $userId = Auth::id();
        $pembina = $this->pembinaService->getpembinaByUserId($userId);

        return view('Pembina.index', compact('pembina'));
    }
}