<?php

namespace App\Http\Services\Ormawa;

use App\Models\Proposal_Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProposalKegiatan {

    public function index()
    {
    $userId = Auth::user()->id;

    // Dapatkan data proposal kegiatan yang terkait dengan pengguna yang sedang login
    $proposalKegiatan = Proposal_Kegiatan::whereHas('skLegalitas.pengajuanLegalitas.ormawaPembina.ormawa.pengguna', function ($query) use ($userId) {
        $query->where('id', $userId);
    })->get();
    // dd($proposalKegiatan);

    // Kemudian kembalikan data ke blade
    $data = [
        'proposalKegiatan' => $proposalKegiatan,
    ];

    return view('Ormawa/ProposalKegiatan/index', $data);
    }

    public function unggah()
    {
            return view('Ormawa/ProposalKegiatan/unggah');
    }


    public function menunggu()
    {
        $data = [
            'content' => 'ormawa/proposalKegiatan/menunggu',
        ];
        return view('Ormawa/ProposalKegiatan/menunggu', $data);
    }

    public function listRevisi()
    {
        $data = [
            'content' => 'ormawa/proposalKegiatan/listRevisi',
        ];
        return view('Ormawa/ProposalKegiatan/ListRevisi', $data);
    }

    public function Revisi()
    {
        $data = [
            'content' => 'ormawa/proposalKegiatan/Revisi',
        ];
        return view('Ormawa/ProposalKegiatan/Revisi', $data);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        // Validasi input
        $request->validate([
            'kegiatanTextArea-0' => 'required|string',
            'kegiatanTextArea-1' => 'required|string',
            'kegiatanTextArea-2' => 'required|string',
            'kegiatanTextArea-3' => 'required|string',
            'kegiatanTextArea-4' => 'required|string',
            'kegiatanTextArea-5' => 'required|string',
            'kegiatanTextArea-6' => 'required|string',
            'kegiatanTextArea-7' => 'required|string',
            'kegiatanTextArea-8' => 'required|string',
            'kegiatanTextArea-9' => 'required|string',
            'kegiatanTextArea-10' => 'required|string',
            'kegiatanTextArea-11' => 'required|string',
            'kegiatanTextArea-12' => 'required|string',
            // Aturan validasi untuk input file
            'files.*' => 'required|file|max:5120',
        ]);

        // Simpan data ke dalam variabel
        $textData = [];
        $textAreaFields = [
            'judul_kegiatan',
            'pendahuluan_kegiatan',
            'tujuan_kegiatan',
            'nama_kegiatan',
            'bentuk_kegiatan',
            'sasaran',
            'parameter_keberhasilan',
            'waktu_dan_tempat_kegiatan',
            'sususan_acara',
            'rancangan_anggaran_biaya',
            'kepanitiaan',
            'penanggung_jawab',
            'penutup',
        ];
        
        foreach ($textAreaFields as $index => $field) {
            $textAreaKey = "kegiatanTextArea-$index";
            $textData[$field] = $request->$textAreaKey;
        }

        $fileData = [];
        $fileFields = [
            'sampul_depan',
            'lampiran1',
            'lampiran2',
            'lampiran3',
            'sampul_belakang',
        ];
        $data = [
            'Sampul depan',
            'Lampiran1',
            'Lampiran2',
            'Lampiran3',
            'Sampul_belakang',
        ];
        
        // Proses setiap file
        foreach ($fileFields as $index => $field) {
            $fileInputName = 'file-upload-' . $index;
            
            if ($request->hasFile($fileInputName)) {
                $uploadedFile = $request->file($fileInputName);
                if ($uploadedFile) {
                    // Dapatkan nama file yang diinginkan
                    $desiredFileName = $data[$index] . '.' . $uploadedFile->getClientOriginalExtension();

                    // Simpan file ke storage
                    $path = $uploadedFile->storeAs('public/Proposal_kegiatan', $desiredFileName);
                    $path = str_replace('public/Proposal_kegiatan/', '', $path);
                    // Simpan path file ke array fileData
                    $fileData[$field] = $path;
                }
            }
        }
        $sk_legalitas = null;
        foreach ($user->ormawa as $ormawa) {
            foreach ($ormawa->ormawaPembina as $ormawaPembina) {
                // Dapatkan pengajuan legalitas untuk ormawa pembina ini
                $pengajuanLegalitas = $ormawaPembina->pengajuanLegalitas()->latest()->first();

                // Pastikan pengajuan legalitas ditemukan
                if ($pengajuanLegalitas) {
                    // Dapatkan SK legalitas terkait
                    $sk_legalitas = $pengajuanLegalitas->skLegalitas;
                    // Jika SK legalitas ditemukan, hentikan iterasi
                    if ($sk_legalitas) {
                        break 2;
                    }
                }
            }
        }

        // Masukkan data teks dan file ke dalam model Proposal_Kegiatan
        $proposal_kegiatan = Proposal_Kegiatan::create(array_merge(
            ['id_SK_legalitas' => $sk_legalitas->id], // Tambahkan ID SK legalitas ke dalam data
            $textData, 
            $fileData
        ));

        if (!$proposal_kegiatan->status) {
            $proposal_kegiatan->status = 'Menunggu';
        }

        // Simpan model untuk menyimpan perubahan ke database
        $proposal_kegiatan->save();

        // Arahkan ke halaman berikutnya
        return redirect()->route('waitingrevision');
    }
}
