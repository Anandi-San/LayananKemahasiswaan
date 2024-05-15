<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\Pembina;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class PembinaService {
    public function index()
    {
        // Menggunakan eager loading untuk memuat ormawaPembina dan data terkait ormawa
        $pembinaList = Pembina::with('ormawaPembina.ormawa')->get();
        // dd($pembinaList);
        
        // Mengirimkan data ke view
        return $pembinaList;
    }

    public function edit($id)
    {
        // Dapatkan data ormawa berdasarkan ID
        $pembina = Pembina::findOrFail($id);
        // dd($pembina);
        
        // Kirim data ormawa ke halaman edit
        return view('Kemahasiswaan.pembina.edit', compact('pembina'));
    }
    public function update(Request $request, $id)
    {
        $pembina = Pembina::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_pembina' => 'required|string|max:255',
            'photo_pembina' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Menghapus foto lama jika ada file baru yang diunggah
        if ($request->hasFile('photo_pembina')) {
            // Menghapus gambar lama jika ada
            if ($pembina->photo_pembina) {
                File::delete(public_path($pembina->photo_pembina));
            }
    
            // Simpan gambar baru ke direktori public/ormawa
            $logo = $request->file('photo_pembina');
            $logoPath = 'pembina/'. $logo->getClientOriginalName();
            $logo->move(public_path('pembina'), $logoPath);
    
            // Simpan path gambar baru
            $pembina->photo_pembina = $logoPath;
        } 

        // Perbarui data pembina
        $pembina->nama_pembina = $request->input('nama_pembina');
        $pembina->save();

        // Redirect ke halaman yang sesuai setelah pembaruan
        return view('Kemahasiswaan.pembina.edit', compact('pembina'));
    }
    public function create()
    {
    return view('Kemahasiswaan.pembina.store');
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:tbl_pengguna',
            'password' => 'required|string|min:8',
            'nama_pembina' => 'required|string|max:255',
            'photo_pembina' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $pengguna = new Pengguna;
        $pengguna->email = $request->email;
        $pengguna->password = bcrypt($request->password);
        $pengguna->role = 'Pembina';
        $pengguna->save();


        $pembina = new Pembina;
        $pembina->id_pengguna = $pengguna->id;
        $pembina->nama_pembina = $request->nama_pembina;

        if($request->hasFile('photo_pembina')){
            $logo = $request->file('photo_pembina');
            $logoPath = 'pembina/'. $logo->getClientOriginalName();
            $logo->move(public_path('pembina'), $logoPath);
            $pembina->photo_pembina = $logoPath;
    }   
        $pembina->save();

    return redirect()->route('Pembina.index');
    }

    public function destroy(string $id)
    {
        // Cari ormawa berdasarkan ID
        $pembina = Pembina::findOrFail($id);
        
        // Lakukan soft delete
        $pembina->delete();

        return redirect()->route('pembina.index');
    }

}