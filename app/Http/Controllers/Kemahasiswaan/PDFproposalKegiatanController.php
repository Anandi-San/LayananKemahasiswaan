<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\PdfProposalKegiatanService;
use Illuminate\Http\Request;

class PDFproposalKegiatanController extends Controller
{
    protected $pdfProposalKegiatanService;
    
    public function __construct(PdfProposalKegiatanService $pdfProposalKegiatanService)
    {
        $this->pdfProposalKegiatanService = $pdfProposalKegiatanService;
    }
    
    public function edit($id, $type)
    {
        // Panggil service untuk mendapatkan data PDF yang diperlukan
        $result = $this->pdfProposalKegiatanService->edit($id, $type);
        
        // Kembalikan view dengan data yang diperlukan
        return view('Kemahasiswaan.proposalKegiatan.edit', $result);
    }
}
