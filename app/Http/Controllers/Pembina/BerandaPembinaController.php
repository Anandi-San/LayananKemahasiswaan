<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Pembina\PembinaService;
use Illuminate\Support\Facades\Auth;


class BerandaPembinaController extends Controller
{
    protected $pembinaService;

    public function __construct(PembinaService $pembinaService)
    {
        $this->pembinaService = $pembinaService;
    }

    public function getPembinaByUserId()
    {
        $userId = Auth::id();
        $pembina = $this->pembinaService->getpembinaByUserId($userId);

        // return view('Pembina.index', compact('pembina'));
    }

    public function index()
    {
        return $this->pembinaService->index();
    }

    public function getProposalKegiatan(string $id)
    {
        $data = $this->pembinaService->getProposalKegiatan($id);

        if ($data) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ]);
        }

        return response()->json([
            'status' => 'failed',
            'message' => 'Data not found',
        ], 404);
    }
}