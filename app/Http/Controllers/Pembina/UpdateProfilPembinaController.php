<?php

namespace App\Http\Controllers\Pembina;

use App\Http\Controllers\Controller;
use App\Http\Services\Pembina\UpdateProfilPembinaService;
use App\Models\Pembina;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UpdateProfilPembinaController extends Controller
{
    protected $updateprofilPembinaService;

    public function __construct(UpdateProfilPembinaService $updateprofilPembinaService)
    {
        $this->updateprofilPembinaService = $updateprofilPembinaService;
    }

    public function index()
    {
        $profil = $this->updateprofilPembinaService->index()->first();
        // dd($profil);

        return view('Pembina/Editprofil/index', compact('profil'));
    }

    // public function uploadLogo(Request $request)
    // {
    //     $profil = $this->updateprofilPembinaService->index()->first();
    
    //     if ($profil && $request->hasFile('logo')) {
    //         try {
    //             $file = $request->file('logo');
    //             $this->updateprofilPembinaService->updateLogo($profil, $file);
    //             Alert::success('Sukses', 'Logo berhasil diunggah');
    //         } catch (\Exception $e) {
    //             Alert::error('Gagal', 'Terjadi kesalahan saat mengunggah logo');
    //         }
    //     } else {
    //         Alert::error('Gagal', 'Tidak ada profil yang ditemukan');
    //     }
    
    //     return redirect()->route('editProfil.index');
    // }

    public function updateProfil(Request $request)
    {
        // Dapatkan profil dari database
        $profil = Pembina::first(); // Ubah query sesuai kebutuhan
        
        // Perbarui foto
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $this->updateprofilPembinaService->updateLogo($profil, $file);
            return redirect()->route('edit-profil-pembina.index')->with('success', 'Logo berhasil diunggah');
        }

        // Hapus foto
        if ($request->has('hapus_foto')) {
            $this->updateprofilPembinaService->deleteLogo($profil);
            return redirect()->route('edit-profil-pembina.index')->with('success', 'Logo berhasil dihapus');
        }

        // Perbarui nama_ormawa
        if ($request->filled('nama_pembina')) {
            $profil->nama_pembina = $request->input('nama_pembina');
            $profil->save();
            return redirect()->route('edit-profil-pembina.index')->with('success', 'Data berhasil diperbarui');
        }

        // Jika tidak ada tindakan yang dipilih, redirect kembali dengan pesan error
        return redirect()->route('edit-profil-pembina.index')->with('error', 'Tidak ada tindakan yang dipilih');
    }

}
