<?php

namespace App\Http\Controllers\Kemahasiswaan;

use App\Http\Controllers\Controller;
use App\Http\Services\Kemahasiswaan\UpdateProfilService;
use App\Models\Kemahasiswaan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
// use Illuminate\Support\Facades\Auth;

class UpdateProfilController extends Controller
{
    protected $updateprofilService;

    public function __construct(UpdateProfilService $updateprofilService)
    {
        $this->updateprofilService = $updateprofilService;
    }

    public function index()
    {
        $profil = $this->updateprofilService->index()->first();
        // dd($profil);

        return view('Kemahasiswaan/EditProfil/index', compact('profil'));
    }
    public function getLogoPath()
    {
        $logoPath = $this->updateprofilService->getLogoPath();

        // Mengirim URL atau path gambar ke view
        return view('Kemahasiswaan.Components.layout', ['logoPath' => $logoPath]);
    }

    public function uploadLogo(Request $request)
    {
        $profil = $this->updateprofilService->index()->first();
    
        if ($profil && $request->hasFile('logo')) {
            try {
                $file = $request->file('logo');
                $this->updateprofilService->updateLogo($profil, $file);
                Alert::success('Sukses', 'Logo berhasil diunggah');
            } catch (\Exception $e) {
                Alert::error('Gagal', 'Terjadi kesalahan saat mengunggah logo');
            }
        } else {
            Alert::error('Gagal', 'Tidak ada profil yang ditemukan');
        }
    
        return redirect()->route('editProfil.index');
    }
    
    public function updateProfil(Request $request)
    {
        // Dapatkan profil dari database
        $profil = Kemahasiswaan::first(); // Ubah query sesuai kebutuhan
        
        // Perbarui foto
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $this->updateprofilService->updateLogo($profil, $file);
            return redirect()->route('editProfil.index')->with('success', 'Logo berhasil diunggah');
        }

        // Hapus foto
        if ($request->has('hapus_foto')) {
            $this->updateprofilService->deleteLogo($profil);
            return redirect()->route('editProfil.index')->with('success', 'Logo berhasil dihapus');
        }

        // Perbarui nama_ormawa
        if ($request->filled('ketua_kemahasiswaan')) {
            $profil->ketua_kemahasiswaan = $request->input('ketua_kemahasiswaan');
            $profil->save();
            return redirect()->route('editProfil.index')->with('success', 'Data berhasil diperbarui');
        }

        // Jika tidak ada tindakan yang dipilih, redirect kembali dengan pesan error
        return redirect()->route('editProfil.index')->with('error', 'Tidak ada tindakan yang dipilih');
    }


    // Metode untuk menghapus logo

    // masih tidak mauuu
    public function deleteLogo()
{
    $profil = $this->updateprofilService->index()->first();
    
    if ($profil) {
        $this->updateprofilService->deleteLogo($profil);
        
        // Alihkan ke halaman /editProfil setelah hapus berhasil
        return redirect()->route('editProfil.index')->with('success', 'Logo berhasil dihapus');
    }

    // Jika tidak ada profil yang ditemukan
    return redirect()->route('editProfil.index')->with('error', 'Tidak ada profil yang ditemukan');
}
}