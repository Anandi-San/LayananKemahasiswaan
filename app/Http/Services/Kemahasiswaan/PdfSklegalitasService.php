<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\SKLegalitas;
use Illuminate\Support\Facades\Storage;

class PdfSklegalitasService
{
    public function edit($id, $type)
    {
        // Temukan item berdasarkan ID
        $item = SKLegalitas::find($id);

        // Pilih file PDF berdasarkan tipe yang diberikan
        $pdfFile = '';
        if ($type == 'file_SK') {
            $pdfFile = $item->file_SK;
        }

        return ['pdfFile' => $pdfFile];
    }
}
