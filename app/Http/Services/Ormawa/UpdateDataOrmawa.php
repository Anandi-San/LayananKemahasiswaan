<?php

namespace App\Http\Services\Ormawa;

use App\Models\MonitoringKegiatan;
use App\Models\OrmawaPembina;
use App\Models\Pengguna;
use App\Models\PengurusOrmawa;
use Illuminate\Http\Request;
use App\Models\Ormawa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;


class UpdateDataOrmawa {

    public function index()
    {
        // Mendapatkan ID pengguna yang sedang login
        $user = Auth::user();
        
        // Dapatkan data kemahasiswaan terkait pengguna
        $profil = $user->ormawa;
        // dd($profil);
        
        // Kembalikan data kemahasiswaan
        return $profil;
    }
    public function updateOrmawa(Request $request)
    {
        // Validasi data input
        $request->validate([
            'nama_ormawa' => 'required|string|max:255',
            'singkatan_ormawa' => 'required|string|max:10',
            'jenis_ormawa' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'logo_ormawa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Mendapatkan ID pengguna yang sedang login
        $userId = Auth::id();
    
        // Mengambil data pengguna yang sedang login
        $pengguna = Pengguna::findOrFail($userId);
    
        // Mengambil data Ormawa yang terkait dengan pengguna yang sedang login
        $ormawa = $pengguna->ormawa()->first();
    
        // Update data Ormawa
        $ormawa->nama_ormawa = $request->input('nama_ormawa');
        $ormawa->singkatan = $request->input('singkatan_ormawa');
        $ormawa->jenis_ormawa = $request->input('jenis_ormawa');
        $ormawa->jurusan = $request->input('jurusan');
    
        if ($request->hasFile('logo_ormawa')) {
            // Menghapus gambar lama jika ada
            if ($ormawa->logo_ormawa) {
                File::delete(public_path($ormawa->logo_ormawa));
            }
    
            // Simpan gambar baru ke direktori public/ormawa
            $logo = $request->file('logo_ormawa');
            $logoPath = 'ormawa/'. $logo->getClientOriginalName();
            $logo->move(public_path('ormawa'), $logoPath);
    
            // Simpan path gambar baru
            $ormawa->logo_ormawa = $logoPath;
        } elseif ($request->input('action') === 'delete') {
            // Menghapus gambar lama jika ada
            if ($ormawa->logo_ormawa) {
                File::delete(public_path($ormawa->logo_ormawa));
                $ormawa->logo_ormawa = null;
            }
        }
    
        // Simpan perubahan
        $ormawa->save();
    
        // Redirect atau kirim respons
        return redirect()->back()->with('success', 'Profil Ormawa berhasil diperbarui.');
    }
    

    public function indexKepengurusan()
{
    // Mendapatkan ID pengguna yang sedang login
    $userId = Auth::id();


        // Mengambil data Ormawa yang terkait dengan pengguna yang sedang login
        $ormawa = Ormawa::where('id_pengguna', $userId)->first();

        // Periksa apakah data Ormawa ditemukan
        if (!$ormawa) {
            return response()->json(['error' => 'Data Ormawa tidak ditemukan'], 404);
        }

        // Mengambil data Pengurus Ormawa berdasarkan id_ormawa yang ditemukan
        $pengurusOrmawa = PengurusOrmawa::where('id_ormawa', $ormawa->id)->first();

        // Periksa apakah data Pengurus Ormawa ditemukan
        if (!$pengurusOrmawa) {
            return response()->json(['error' => 'Data Pengurus Ormawa tidak ditemukan'], 404);
        }
        // dd($pengurusOrmawa);

        // Return data Pengurus Ormawa untuk ditampilkan di tampilan
        return $pengurusOrmawa;
}
public function updateKepengurusan(Request $request)
{
    // Validasi data input
    $request->validate([
        'nama_kabinet' => 'required|string|max:255',
        'ketua_ormawa' => 'required|string|max:255',
        'visi' => 'required|string',
        'misi' => 'required|string',
        'logo_kabinet' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Mendapatkan pengguna yang sedang login
    $userId = Auth::id();
    $ormawa = Ormawa::where('id_pengguna', $userId)->first();

    // Periksa apakah ormawa ada
    if (!$ormawa) {
        return response()->json(['error' => 'Data Ormawa tidak ditemukan'], 404);
    }

    // Mengambil data Pengurus Ormawa berdasarkan id_ormawa yang ditemukan
    $pengurusOrmawa = PengurusOrmawa::where('id_ormawa', $ormawa->id)->first();
    
    // Periksa apakah pengurus ormawa ada
    if (!$pengurusOrmawa) {
        return response()->json(['error' => 'Data Pengurus Ormawa tidak ditemukan'], 404);
    }

    // Update data Pengurus Ormawa
    $pengurusOrmawa->nama_kabinet = $request->input('nama_kabinet');
    $pengurusOrmawa->ketua_ormawa = $request->input('ketua_ormawa');
    $pengurusOrmawa->visi = $request->input('visi');
    $pengurusOrmawa->misi = $request->input('misi');
    
    // Proses unggah gambar baru
    if ($request->hasFile('logo_kabinet')) {
        // Menghapus gambar lama jika ada
        if ($pengurusOrmawa->logo_kabinet) {
            File::delete(public_path($pengurusOrmawa->logo_kabinet));
        }
    
        // Unggah gambar baru ke direktori public/ormawa/kepengurusan
        $logo = $request->file('logo_kabinet');
    
        // Tentukan direktori tujuan
        $logoPath = 'ormawa/kepengurusan/';
    
        // Dapatkan nama asli file
        $logoFileName = $logo->getClientOriginalName();
    
        // Simpan file ke direktori `public/ormawa/kepengurusan` dengan nama asli file
        $logo->move(public_path($logoPath), $logoFileName);
    
        // Simpan path file lengkap ke database
        $pengurusOrmawa->logo_kabinet = $logoPath . $logoFileName;
    }
    
    
    // Hapus gambar jika pengguna meminta untuk menghapus gambar
    // Hapus gambar jika pengguna meminta untuk menghapus gambar
if ($request->input('action') === 'delete') {
    if ($pengurusOrmawa->logo_kabinet) {
        // Dapatkan path file yang ingin dihapus
        $filePath = public_path($pengurusOrmawa->logo_kabinet);
        
        // Cek apakah file benar-benar ada sebelum mencoba menghapusnya
        if (File::exists($filePath)) {
            // Hapus file gambar
            File::delete($filePath);
        }
        
        // Setel logo_kabinet ke null di database
        $pengurusOrmawa->logo_kabinet = null;
    }
}


    // Simpan semua perubahan yang diperbarui
    $pengurusOrmawa->save();

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Data Pengurus Ormawa berhasil diperbarui.');
}

// service
    public function indexKegiatan()
    {
        // Ambil ID pengguna saat ini
        $userId = Auth::id();
        
        // Ambil pengguna berdasarkan ID
        $user = Pengguna::find($userId);

        // Dapatkan Ormawa yang terkait dengan pengguna
        $ormawa = $user->ormawa->first();

        // Jika tidak ada data Ormawa, tampilkan pesan kesalahan
        if (!$ormawa) {
            dd('Tidak ada data Ormawa ditemukan');
        }

        // Dapatkan relasi OrmawaPembina yang terkait dengan Ormawa
        $ormawaPembina = $ormawa->ormawaPembina;

        // Array untuk menyimpan data proposal kegiatan
        $proposalKegiatanOptions = [];


        // Iterasi melalui setiap OrmawaPembina untuk mengumpulkan data proposal kegiatan dan monitoring kegiatan
        // Iterasi melalui setiap OrmawaPembina untuk mengumpulkan data proposal kegiatan dan monitoring kegiatan
    foreach ($ormawaPembina as $pembina) {
        // Iterasi melalui setiap pengajuan legalitas
        foreach ($pembina->pengajuanLegalitas as $pengajuan) {
            // Muat SKLegalitas yang terkait dengan pengajuan
            $pengajuan->load('skLegalitas');

            // Cek apakah ada SKLegalitas yang dimuat
            if ($pengajuan->skLegalitas) {
                // Dapatkan SKLegalitas
                $skLegalitas = $pengajuan->skLegalitas;

                // Iterasi melalui setiap Proposal Kegiatan pada SKLegalitas
                foreach ($skLegalitas->proposalKegiatan as $proposal) {
                    // Tambahkan nama proposal kegiatan ke dalam array opsi
                    $proposalKegiatanOptions[$proposal->id] = $proposal->nama_kegiatan;

                    // Dapatkan data monitoring kegiatan berdasarkan id_ormawa
                    $monitoringKegiatan[] = MonitoringKegiatan::where('id_ormawa', $ormawa->id)->first();
                }
            }
        }
    }
    // dd($proposalKegiatanOptions);


        // Siapkan data yang akan dikirim ke view
        $data = [
            'proposalKegiatanOptions' => $proposalKegiatanOptions,
            'monitoringKegiatan' => $monitoringKegiatan
        ];

        // Return view dengan data
        return $data;
    }




    public function updateKegiatan(Request $request)
    {
        dd($request);
    }
}
