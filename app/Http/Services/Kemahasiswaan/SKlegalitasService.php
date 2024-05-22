<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\Ormawa;
use App\Models\OrmawaPembina;
use App\Models\SKlegalitas;
use Illuminate\Http\Request;

class SKlegalitasService
{
    public function index()
    {
        $skLegalitas = SKlegalitas::with('pengajuanLegalitas.ormawaPembina.ormawa')->get();
        // dd($skLegalitas);

        return $skLegalitas;
    }

    public function create()
    {
        $ormawaList = Ormawa::all();

        // Menyiapkan data yang diperlukan
        $data = [
            'ormawaList' => $ormawaList,
        ];

        return view('kemahasiswaan.sklegalitas.add', $data);
    }

    public function store(Request $request)
    {
        // dd($request);
        // Validasi input
        $request->validate([
            'id_ormawa' => 'required',
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

        // Dapatkan id_ormawa yang dipilih dari form
        $idOrmawa = $request->input('id_ormawa');
        // dd($idOrmawa);

        // Temukan SKlegalitas yang sesuai berdasarkan id_ormawa
        $idPengajuanLegalitas = OrmawaPembina::where('id_ormawa', $idOrmawa)
        ->firstOrFail()
        ->pengajuanLegalitas()->first();
        // dd($idPengajuanLegalitas);

        if ($idPengajuanLegalitas) {
            $PengajuanLegalitas = $idPengajuanLegalitas->id;
            // dd($PengajuanLegalitas);

        // Buat objek SKlegalitas baru
        $skLegalitasBaru = new SKlegalitas();
        $skLegalitasBaru->id_pengajuan_legalitas = $PengajuanLegalitas;
        $skLegalitasBaru->nomor_SK = $request->input('nomor_SK');
        $skLegalitasBaru->tanggal_terbit = $request->input('tanggal_terbit');
        $skLegalitasBaru->tanggal_berlaku_mulai = $request->input('tanggal_berlaku_mulai');
        $skLegalitasBaru->tanggal_berlaku_selesai = $request->input('tanggal_berlaku_selesai');

        // Simpan path file ke database jika file diunggah
        if ($filePath) {
            $skLegalitasBaru->file_SK = $filePath;
        }

        // Simpan data ke database
        $skLegalitasBaru->save();

        // Redirect setelah menyimpan
        return redirect()->route('editSKlegalitas.index');
    } else {
        return view ('kemahasiswaan.sklegalitas.belumDisetujui');
    }
    }
}