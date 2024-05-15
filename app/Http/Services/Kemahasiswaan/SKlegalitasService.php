<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\SKlegalitas;
use Illuminate\Http\Request;

class SKlegalitasService {
public function index()
    {
        $skLegalitas = SKlegalitas::with('pengajuanLegalitas.ormawaPembina.ormawa')->get();
        // dd($skLegalitas);

        return $skLegalitas;
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nomor_SK' => 'required|string|max:255',
            'tanggal_terbit' => 'required|date',
            'tanggal_berlaku_mulai' => 'required|date',
            'tanggal_berlaku_selesai' => 'required|date',
            'file_SK' => 'required|file|max:5000|mimes:pdf,doc,docx', // Validasi file
        ]);
    
        // Inisialisasi variabel untuk menyimpan path file
        $filePath = null;
    
        // Simpan file ke path storage/app/public/sk_legalitas dengan nama file yang diinginkan
        if ($request->hasFile('file_SK')) {
            $file = $request->file('file_SK');
            
            // Tentukan nama file yang akan disimpan (misalnya menggunakan nama asli file)
            $fileName = $file->getClientOriginalName();
            
            // Simpan file dengan menggunakan metode storeAs() di direktori 'public/sk_legalitas'
            $filePath = $file->storeAs('public/sk_legalitas', $fileName);
            
            // Mengubah path file untuk disimpan di database
            $filePath = str_replace('public/sk_legalitas/', '', $filePath);
        }
    
        // Buat objek SKlegalitas baru
        $skLegalitas = new SKlegalitas();
        $skLegalitas->id_pengajuan_legalitas = 1;
        $skLegalitas->nomor_SK = $request->input('nomor_SK');
        $skLegalitas->tanggal_terbit = $request->input('tanggal_terbit');
        $skLegalitas->tanggal_berlaku_mulai = $request->input('tanggal_berlaku_mulai');
        $skLegalitas->tanggal_berlaku_selesai = $request->input('tanggal_berlaku_selesai');
        
        // Simpan path file ke database jika file diunggah
        if ($filePath) {
            $skLegalitas->file_SK = $filePath;
        }
    
        // Simpan data ke database
        $skLegalitas->save();
    
        // Redirect setelah menyimpan
        return redirect()->route('editSKlegalitas.index');
    }
    
}