<?php

namespace App\Http\Services\Ormawa;

use App\Models\LPJKegiatan;
use App\Models\Proposal_Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PengajuanLPJkegiatan {

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

    return view('Ormawa/LpjKegiatan/index', $data);
    }
    public function unggah($id)
    {
        // Periksa apakah ada data LPJ untuk proposal_id yang diberikan
        $lpjKegiatan = LPJKegiatan::where('id_proposal_kegiatan', $id)->first();

        if ($lpjKegiatan && $lpjKegiatan->status === 'Menunggu') {
            // Jika data LPJ ada dan statusnya "Menunggu", arahkan ke halaman menungguLPJKegiatan
            return redirect()->route('menungguLPJKegiatan');
        } elseif 
            ($lpjKegiatan && $lpjKegiatan->status === 'Revisi Pembina') {
            // Jika data LPJ ada dan statusnya "Menunggu", arahkan ke halaman menungguLPJKegiatan
            return redirect()->route('ListRevisiLPJKegiatan');
        } elseif 
            ($lpjKegiatan && $lpjKegiatan->status === 'Telah Direvisi') {
            // Jika data LPJ ada dan statusnya "Menunggu", arahkan ke halaman menungguLPJKegiatan
            return redirect()->route('ListRevisiLPJKegiatan');
        } elseif 
            ($lpjKegiatan && $lpjKegiatan->status === 'Disetujui Pembina') {
            // Jika data LPJ ada dan statusnya "Menunggu", arahkan ke halaman menungguLPJKegiatan
            return redirect()->route('ListRevisiLPJKegiatan');
        } elseif 
            ($lpjKegiatan && $lpjKegiatan->status === 'Revisi Kemahasiswaan') {
            // Jika data LPJ ada dan statusnya "Menunggu", arahkan ke halaman menungguLPJKegiatan
            return redirect()->route('ListRevisiLPJKegiatan');
        } elseif 
            ($lpjKegiatan && $lpjKegiatan->status === 'Telah Direvisi Kemahasiswaan') {
            // Jika data LPJ ada dan statusnya "Menunggu", arahkan ke halaman menungguLPJKegiatan
            return redirect()->route('ListRevisiLPJKegiatan');
        } elseif 
            ($lpjKegiatan && $lpjKegiatan->status === 'Disetujui') {
            // Jika data LPJ ada dan statusnya "Menunggu", arahkan ke halaman menungguLPJKegiatan
            return redirect()->route('ListRevisiLPJKegiatan');
        }

        // Jika tidak ada atau statusnya berbeda, lanjutkan dengan logika saat ini
        $data = [
            'proposal_id' => $id,
        ];

        return view('Ormawa/LpjKegiatan/unggah', $data);
    }


    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            // Aturan validasi untuk input teks
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
        // dd($request);
        // dd($request);
        $proposalId = $request->proposal_id;
        // dd($proposalId);
        

        // Simpan data ke dalam variabel
        $textData = [];
        $textAreaFields = [
            'judul_LPJ',
            'pendahuluan_LPJ',
            'tujuan_LPJ',
            'nama_dan_tema_kegiatan',
            'sasaran_kegiatan',
            'laporan_kegiatan',
            'realisasi_pencapaian',
            'evaluasi_kegiatan',
            'susunan_acara',
            'kepanitiaan',
            'dokumentasi_kegiatan',
            'penangung_jawab_kegiatan',
            'penutup',
        ];
        
        foreach ($textAreaFields as $index => $field) {
            $textAreaKey = "kegiatanTextArea-$index";
            $textData[$field] = $request->$textAreaKey;
        }

        $fileData = [];
        $fileFields = [
            'SPJ_kegiatan',
            'sampul_depan',
            'lampiran1',
            'lampiran2',
            'lampiran3',
            'sampul_belakang',
        ];
        $data = [
            'SPJ Kegiatan',
            'Sampul Depan',
            'Lampiran 1',
            'Lampiran 2',
            'Lampiran 3',
            'Sampul Belakang',
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
                    $path = $uploadedFile->storeAs('public/lpjKegiatan', $desiredFileName);
                    $path = str_replace('public/lpjKegiatan/', '', $path);
                    // Simpan path file ke array fileData
                    $fileData[$field] = $path;
                }
            }
        }

        // Masukkan data teks dan file ke dalam model Proposal_Kegiatan
        $lpjKegiatan = LPJKegiatan::updateOrCreate(
            ['id_proposal_kegiatan' => $proposalId], // Tentukan kondisi pencarian
            array_merge($textData, $fileData)
        );
        if (!$lpjKegiatan->status) {
        $lpjKegiatan->status = 'Menunggu';
    }

        // Simpan model untuk menyimpan perubahan ke database
        $lpjKegiatan->save();

        // Arahkan ke halaman berikutnya
        return redirect()->route('waitingrevision');
    }

    public function menunggu()
    {
        $data = [
            'content' => 'ormawa/LpjKegiatan/menunggu',
        ];
        return view('Ormawa/LpjKegiatan/menunggu', $data);
    }

    public function listRevisi()
    {
        $data = [
            'content' => 'ormawa/LpjKegiatan/listRevisi',
        ];
        return view('Ormawa/LpjKegiatan/listRevisi', $data);
    }

    public function Revisi()
    {
        $data = [
            'content' => 'ormawa/LpjKegiatan/revisi',
        ];

        return view('Ormawa/LpjKegiatan/revisi', $data);
    }

    // ATUR Status
    
}
