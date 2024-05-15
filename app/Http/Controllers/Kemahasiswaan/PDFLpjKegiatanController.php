<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Kemahasiswaan\pdfLPJkegiatanService;

class PDFLpjKegiatanController extends Controller
{
    protected $pdfLPJkegiatanService;

    public function __construct(pdfLPJkegiatanService $pdfLPJkegiatanService)
    {
        $this->pdfLPJkegiatanService = $pdfLPJkegiatanService;
    }

    public function edit($id, $type)
    {
        // Gunakan service untuk mendapatkan file PDF yang dipilih berdasarkan ID dan tipe
        $data = $this->pdfLPJkegiatanService->edit($id, $type);
        
        // Periksa apakah file PDF ada dalam data yang dikembalikan
        if (isset($data['pdfFile'])) {
            // Kembalikan view kemahasiswaan.lpjKegiatan.edit dengan file PDF yang dipilih
            return view('kemahasiswaan.lpjKegiatan.edit', ['pdfFile' => $data['pdfFile']]);
        } else {
            // Jika file tidak ditemukan, arahkan kembali dengan pesan kesalahan
            return back()->with('error', 'File PDF tidak ditemukan');
        }
    }
}
