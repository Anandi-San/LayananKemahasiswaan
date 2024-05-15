<?php

namespace App\Http\Services\Pembina;
use App\Models\Pembina;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UpdateProfilPembinaService {

    public function index()
    {
        $user = Auth::user();
        
        // Dapatkan data Pembina terkait pengguna
        $profil = $user->pembina;
        // dd($profil);

        return $profil;
    }

    public function updateLogo(Pembina $profil, UploadedFile $file)
    {

        $user = Auth::user();
        
        // Dapatkan data Pembina terkait pengguna
        $profil = $user->pembina->first();
        // dd($profil);

        // Hapus logo lama jika ada
        if ($profil->photo_pembina) {
            $oldLogoPath = public_path($profil->photo_pembina);
            if (file_exists($oldLogoPath)) {
                unlink($oldLogoPath);
            }
        }
        
        // Pindahkan logo baru ke direktori kemahasiswaan
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'pembina/' . $fileName;
        $file->move(public_path('pembina'), $fileName);
        
        // Perbarui profil dengan path logo baru
        $profil->photo_pembina = $filePath;
        $profil->save();
    }
    
    public function deleteLogo(Pembina $profil)
    {

        $user = Auth::user();
        
        // Dapatkan data Pembina terkait pengguna
        $profil = $user->pembina->first();

        if ($profil->photo_pembina) {
            $filePath = public_path($profil->photo_pembina);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            // Hapus path logo dari database
            $profil->photo_pembina = null;
            $profil->save();
        }
    }
}


