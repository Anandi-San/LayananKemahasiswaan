<?php

namespace App\Http\Services\Kemahasiswaan;
use App\Models\PengajuanLegalitas;

class PdfpengajuanKemahasiswaanService {
    public function edit($id, $type)
    {
        // Temukan item berdasarkan ID
        $item = PengajuanLegalitas::find($id);

        // Pilih file PDF berdasarkan tipe yang diberikan
        $pdfFile = '';
        if ($type == 'proposal_legalitas') {
            $pdfFile = $item->proposal_legalitas;
        } elseif ($type == 'AD_ART') {
            $pdfFile = $item->AD_ART;
        } elseif ($type == 'surat_permohonan') {
            $pdfFile = $item->surat_permohonan;
        } elseif ($type == 'daftar_nama_kepengurusan') {
            $pdfFile = $item->daftar_nama_kepengurusan;
        } elseif ($type == 'biodata_pembina') {
            $pdfFile = $item->biodata_pembina;
        } elseif ($type == 'struktur_organisasi') {
            $pdfFile = $item->struktur_organisasi;
        } elseif ($type == 'daftar_sarana_prasarana') {
            $pdfFile = $item->daftar_sarana_prasarana;
        } elseif ($type == 'GBHK') {
            $pdfFile = $item->GBHK;
        } elseif ($type == 'LPJ_kepengurusan') {
            $pdfFile = $item->LPJ_kepengurusan;
        }
        // dd($pdfFile);

        // Jika file PDF ditemukan, arahkan pengguna ke halaman edit
        if ($pdfFile) {
            return view('Kemahasiswaan.pengajuanLegalitas.edit', ['pdfFile' => $pdfFile]);
        } else {
            // Jika file tidak ditemukan, tampilkan pesan kesalahan atau kembali
            return back()->with('error', 'File PDF tidak ditemukan');
        }
    }
}