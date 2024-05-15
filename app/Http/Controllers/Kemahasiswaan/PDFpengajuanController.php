<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\PdfpengajuanKemahasiswaanService;

class PDFpengajuanController extends Controller
{
    protected $pdfpengajuanKemahasiswaanService;
    
    public function __construct(PdfpengajuanKemahasiswaanService $pdfpengajuanKemahasiswaanService)
    {
        $this->pdfpengajuanKemahasiswaanService = $pdfpengajuanKemahasiswaanService;
    }
    
    public function edit($id, $type)
    {
        $result = $this->pdfpengajuanKemahasiswaanService->edit($id, $type);

        if ($result instanceof \Illuminate\View\View) {
            return $result;
        }

        // Jika hasil tidak sesuai dengan yang diharapkan, kembalikan respons kesalahan
        return back()->with('error', 'File PDF tidak ditemukan');
    }
}
