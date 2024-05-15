<?php

namespace App\Http\Services\SuperAdmin;
use App\Models\Kemahasiswaan;


Class editKemahasiswaanService {
    public function index()
    {
    $dataKemahasiswaan = Kemahasiswaan::all();
    // dd($dataKemahasiswaan);

    return view("SuperAdmin.editKemahasiswaan.index", ['dataKemahasiswaan' => $dataKemahasiswaan]);
    }

    public function nonaktifkan($request, $id)
    {
        // Temukan entitas Kemahasiswaan berdasarkan ID
        $kemahasiswaan = Kemahasiswaan::findOrFail($id);
        
        // Ubah status entitas menjadi "Tidak Aktif"
        $kemahasiswaan->status = "tidak aktif";
        
        // Simpan perubahan ke database
        $kemahasiswaan->save();
        
        // Redirect dengan pesan sukses atau kembali ke halaman sebelumnya
        return redirect()->route('edit.kemahasiswaan')->with('success', 'Status berhasil diubah menjadi "Tidak Aktif"');
    }


    public function store($request)
{
    // Validasi input form
    $request->validate([
        'logo_kemahasiswaan' => 'image|mimes:jpg,png,jpeg|max:2048',
        'ketua_kemahasiswaan' => 'required|string|max:255',
        'status' => 'required|string',
        'jabatan_mulai' => 'required|date',
        'jabatan_selesai' => 'required|date|after_or_equal:jabatan_mulai',
    ]);

    // Simpan data ke dalam model Kemahasiswaan
    $kemahasiswaan = new Kemahasiswaan;
    $kemahasiswaan->ketua_kemahasiswaan = $request->ketua_kemahasiswaan;
    $kemahasiswaan->status = $request->status;
    $kemahasiswaan->jabatan_mulai = $request->jabatan_mulai;
    $kemahasiswaan->jabatan_selesai = $request->jabatan_selesai;
    
    // Jika ada file gambar yang diunggah, simpan dan atur path gambar
    if ($request->hasFile('logo_kemahasiswaan')) {
        $file = $request->file('logo_kemahasiswaan');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'kemahasiswaan/' . $fileName;
        $file->move(public_path('kemahasiswaan'), $fileName);
        
        // Perbarui profil dengan path logo baru
        $kemahasiswaan->logo_kemahasiswaan = $filePath;
    }

    // Set id_pengguna dan id_superadmin
    $kemahasiswaan->id_pengguna = 3;
    $kemahasiswaan->id_superadmin = 1;

    // Simpan model ke basis data
    $kemahasiswaan->save();

    // Redirect atau respons yang sesuai
}


    public function edit()
    {
    $dataKemahasiswaan = Kemahasiswaan::all();
    // dd($dataKemahasiswaan);

    return view("SuperAdmin.editKemahasiswaan.edit", ['dataKemahasiswaan' => $dataKemahasiswaan]);
    }

    public function indexHistory()
    {
        // Mengambil semua data termasuk yang soft deleted menggunakan withTrashed()
        $dataHistoryKemahasiswaan = Kemahasiswaan::withTrashed()->get();

        // Debugging untuk memeriksa data yang didapat
        // dd($dataHistoryKemahasiswaan);

        // Mengirim data ke view
        return view("SuperAdmin.historyKemahasiswaan.index", ['dataHistoryKemahasiswaan' => $dataHistoryKemahasiswaan]);
    }

}
    
    