<?php

namespace App\Http\Services\Ormawa;

use App\Models\OrmawaPembina;
use App\Models\PengajuanLegalitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UnggahLegalitas
{

    public function index($proposal)
    {
    $user = Auth::user();
    

    // Cek apakah pengguna merupakan pembina ormawa
    $ormawaPembina = $user->ormawaPembina->first();
    // dd($ormawaPembina);


    // Dapatkan pengajuan legalitas yang terkait dengan pengguna
    $legalitas = $ormawaPembina->pengajuanLegalitas->first();

    if ($legalitas) {
        // Jika pengajuan legalitas sudah ada, periksa statusnya
        if ($legalitas->status === 'Menunggu') {
            return redirect()->route('waitingrevision');
        } elseif ($legalitas->status === 'Revisi Kemahasiswaan') {
            // Jika pengajuan legalitas sudah disetujui, arahkan ke halaman tertentu
            return redirect()->route('listRevisi');
        } elseif ($legalitas->status === 'Telah Dorevisi') {
            return redirect()->route('revision');
    }
}

    // Jika belum mengunggah, tampilkan halaman unggah legalitas
    $data = [
        'content' => 'ormawa/legalitas/index',
        'proposal' => $proposal,
    ];
    return view('Ormawa/UnggahPengajuanLegalitas/index', $data);
    }

    public function waitRevision()
    {
        $data = [
            'content' => 'ormawa/legalitas/index',
        ];
        return view('Ormawa/UnggahPengajuanLegalitas/waitingRevision', $data);
    }

    public function ListRevisi()
    {
        $data = [
            'content' => 'ormawa/legalitas/index',
        ];
        return view('Ormawa/UnggahPengajuanLegalitas/listRevisi', $data);
    }
    public function Revision()
    {
        $data = [
            'content' => 'ormawa/legalitas/index',
        ];
        return view('Ormawa/UnggahPengajuanLegalitas/revision', $data);
    }

    public function store(Request $request)
    {
        // Validasi file yang diunggah
        $request->validate([
            'files.*' => 'required|file|max:5120',
        ]);
        // dd($request);   
        // Daftar nama file yang diinginkan
        $listFile = [
            'proposal_legalitas',
            'AD_ART',
            'surat_permohonan',
            'biodata_pembina',
            'struktur_organisasi',
            'daftar_sarana_prasarana',
            'GBHK',
            'LPJ_kepengurusan',
        ];

        // Nama file yang diinginkan dari `$data`
        $data = [
            'Proposal legalitas',
            'AD ART',
            'Surat permohonan',
            'Biodata pembina',
            'struktur organisasi',
            'daftar sarana prasarana',
            'GBHK',
            'LPJ kepengurusan',
        ];

        // Dapatkan ID pengguna yang sedang login
        $userId = Auth::id();
        // dd($userId);

        // Cari data OrmawaPembina yang sesuai dengan ID pengguna yang sedang login
        $pivot = OrmawaPembina::where('id_ormawa', $userId)->first();

        if (!$pivot) {
            return redirect()->back()->with('error', 'Tidak dapat menemukan data OrmawaPembina yang sesuai.');
        }

        // Variabel untuk memeriksa apakah semua file telah diunggah
        $allFilesUploaded = false;

        // Iterasi melalui file yang diunggah
        foreach ($listFile as $index => $fileName) {
            $fileInputName = 'file-upload-' . $index;

            if ($request->hasFile($fileInputName)) {
                $uploadedFile = $request->file($fileInputName);

                if ($uploadedFile) {
                    // Dapatkan nama file yang diinginkan dari `$data`
                    $desiredFileName = $data[$index] . '.' . $uploadedFile->getClientOriginalExtension();

                    // Simpan file ke storage dalam folder 'public/legalitas'
                    $path = $uploadedFile->storeAs('public/legalitas', $desiredFileName);

                    // Hapus awalan 'public/legalitas/' dari jalur file untuk disimpan di database
                    $path = str_replace('public/legalitas/', '', $path);

                    // Simpan atau perbarui data PengajuanLegalitas
                    PengajuanLegalitas::updateOrCreate(
                        [
                            'id_ormawa_pembina' => $pivot->id,
                            'id_kemahasiswaan' => null,
                        ],
                        [
                            $fileName => $path,
                            'status' => 'menunggu'
                        ]
                    );
                }
            }
        }

        // Jika semua file telah diunggah, arahkan ke halaman berikutnya
        return redirect()->route('waitingrevision');
    }

    public function update(Request $request)
{
    // Validasi file yang diunggah
    $request->validate([
        'files.*' => 'required|file|max:5120',
    ]);

    // Daftar nama file yang diinginkan
    $listFile = [
        'proposal_legalitas',
        'AD_ART',
        'surat_permohonan',
        'biodata_pembina',
        'struktur_organisasi',
        'daftar_sarana_prasarana',
        'GBHK',
        'LPJ_kepengurusan',
    ];

    // Nama file yang diinginkan dari `$data`
    $data = [
        'Proposal legalitas',
        'AD ART',
        'Surat permohonan',
        'Biodata pembina',
        'struktur organisasi',
        'daftar sarana prasarana',
        'GBHK',
        'LPJ kepengurusan',
    ];

    // Dapatkan ID pengguna yang sedang login
    $userId = Auth::id();

    // Cari data OrmawaPembina yang sesuai dengan ID pengguna yang sedang login
    $pivot = OrmawaPembina::where('id_ormawa', $userId)->first();

    if (!$pivot) {
        return redirect()->back()->with('error', 'Tidak dapat menemukan data OrmawaPembina yang sesuai.');
    }

    // Variabel untuk memeriksa apakah semua file telah diunggah
    $allFilesUploaded = false;

    // Iterasi melalui file yang diunggah
    foreach ($listFile as $index => $fileName) {
        $fileInputName = 'file-upload-' . $index;

        if ($request->hasFile($fileInputName)) {
            $uploadedFile = $request->file($fileInputName);

            if ($uploadedFile) {
                // Dapatkan nama file yang diinginkan dari `$data`
                $desiredFileName = $data[$index] . '.' . $uploadedFile->getClientOriginalExtension();

                // Simpan file ke storage dalam folder 'public/legalitas'
                $path = $uploadedFile->storeAs('public/legalitas', $desiredFileName);

                // Hapus awalan 'public/legalitas/' dari jalur file untuk disimpan di database
                $path = str_replace('public/legalitas/', '', $path);

                // Perbarui data PengajuanLegalitas
                $legalitas = PengajuanLegalitas::where([
                    'id_ormawa_pembina' => $pivot->id,
                    'id_kemahasiswaan' => null,
                ])->first();

                if ($legalitas) {
                    // Perbarui status menjadi 'menunggu' jika diperlukan
                    $legalitas->update(['status' => 'menunggu']);

                    // Perbarui nama file sesuai dengan indeks dan simpan jalur file
                    $legalitas->update([
                        $fileName => $path,
                    ]);
                }
            }
        }
    }

    // Jika semua file telah diunggah, arahkan ke halaman berikutnya
    return redirect()->route('waitingrevision');
}

}
