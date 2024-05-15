<?php

namespace App\Http\Services\Kemahasiswaan;
use App\Models\Proposal_Kegiatan;

class PdfProposalKegiatanService {
    public function edit($id, $type)
    {
        // Temukan item berdasarkan ID
        $item = Proposal_Kegiatan::find($id);

        // Pilih file PDF berdasarkan tipe yang diberikan
        $pdfFile = '';
        if ($type == 'sampul_depan') {
            $pdfFile = $item->sampul_depan;
        } elseif ($type == 'lampiran1') {
            $pdfFile = $item->lampiran1;
        } elseif ($type == 'lampiran2') {
            $pdfFile = $item->lampiran2;
        } elseif ($type == 'lampiran3') {
            $pdfFile = $item->lampiran3;
        } elseif ($type == 'sampul_belakang') {
            $pdfFile = $item->sampul_belakang;
        }
        dd($pdfFile);

        return ['pdfFile' => $pdfFile];
    }
}