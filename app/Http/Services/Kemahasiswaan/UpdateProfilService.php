<?php

namespace App\Http\Services\Kemahasiswaan;
use App\Models\Kemahasiswaan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateProfilService {

    public function index()
    {
        $user = Auth::user();
        
        // Dapatkan data kemahasiswaan terkait pengguna
        $profil = $user->kemahasiswaan;
        // dd($profil);
        
        // Kembalikan data kemahasiswaan
        return $profil;
    }

    public function updateLogo(Kemahasiswaan $profil, UploadedFile $file)
    {

        $user = Auth::user();
        
        // Dapatkan data kemahasiswaan terkait pengguna
        $profil = $user->kemahasiswaan->first();
        // dd($profil);
        
        // Hapus logo lama jika ada
        if ($profil->logo_kemahasiswaan) {
            $oldLogoPath = public_path($profil->logo_kemahasiswaan);
            if (file_exists($oldLogoPath)) {
                unlink($oldLogoPath);
            }
        }
        
        // Pindahkan logo baru ke direktori kemahasiswaan
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'kemahasiswaan/' . $fileName;
        $file->move(public_path('kemahasiswaan'), $fileName);
        
        // Perbarui profil dengan path logo baru
        $profil->logo_kemahasiswaan = $filePath;
        // dd($profil->logo_kemahasiswaan);
        $profil->save();
    }
    
    public function deleteLogo(Kemahasiswaan $profil)
    {
    $user = Auth::user();
    
    // Dapatkan data kemahasiswaan terkait pengguna
    $profil = $user->kemahasiswaan;

        if ($profil->logo_kemahasiswaan) {
            $filePath = public_path($profil->logo_kemahasiswaan);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Hapus path logo dari database
            $profil->logo_kemahasiswaan = null;
            $profil->save();
        }
    }
}

