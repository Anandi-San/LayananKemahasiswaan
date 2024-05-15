<?php

namespace App\Http\Controllers\kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\PdfSklegalitasService;
use Illuminate\Http\Request;

class PDFskLegalitasController extends Controller
{
    protected $pdfSklegalitasService;

    public function __construct(PdfSklegalitasService $pdfSklegalitasService)
    {
        $this->pdfSklegalitasService = $pdfSklegalitasService;
    }

    public function edit($id, $type)
    {
        // Dapatkan data SK Legalitas berdasarkan ID
        $data = $this->pdfSklegalitasService->edit($id, $type);
        
        // Periksa apakah file PDF ada dalam data yang dikembalikan
        if (isset($data['pdfFile'])) {
            // Kembalikan view kemahasiswaan.lpjKegiatan.edit dengan file PDF yang dipilih
            return view('kemahasiswaan.sklegalitas.edit', ['pdfFile' => $data['pdfFile']]);
        } else {
            // Jika file tidak ditemukan, arahkan kembali dengan pesan kesalahan
            return back()->with('error', 'File PDF tidak ditemukan');
        }
    }
}
