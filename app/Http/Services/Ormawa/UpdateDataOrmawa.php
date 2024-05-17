<?php

namespace App\Http\Services\Ormawa;

use App\Models\KeteranganPembayaran;
use App\Models\MonitoringKegiatan;
use App\Models\OrmawaPembina;
use App\Models\Pengguna;
use App\Models\PengurusOrmawa;
use App\Models\Proposal_Kegiatan;
use Illuminate\Http\Request;
use App\Models\Ormawa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


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

public function indexKegiatan()
{
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

    // Iterasi melalui setiap OrmawaPembina untuk mengumpulkan data proposal kegiatan
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
                    // Tambahkan objek proposal kegiatan ke dalam array opsi
                    $proposalKegiatanOptions[] = $proposal;
                }
                // dd($proposalKegiatanOptions);
            }
        }
    }

    // Kembalikan array data proposal kegiatan
    return view('Ormawa/UpdateOrmawa/indexKegiatan', compact('proposalKegiatanOptions'));
}

// service
    // Controller
    public function editKegiatan($id)
{
    // Ambil ID pengguna saat ini
    $userId = Auth::id();

    // Ambil pengguna berdasarkan ID
    $user = Pengguna::find($userId);

    // Dapatkan Ormawa yang terkait dengan pengguna
    $ormawa = $user->ormawa->first();
    // dd($ormawa);
    // Jika tidak ada data Ormawa, tampilkan pesan kesalahan
    if (!$ormawa) {
        dd('Tidak ada data Ormawa ditemukan');
    }

    // Dapatkan proposal kegiatan berdasarkan ID
    $proposal = Proposal_Kegiatan::findOrFail($id);

    // Jika proposal tidak ditemukan, tampilkan pesan kesalahan
    if (!$proposal) {
        dd('Proposal Kegiatan tidak ditemukan');
    }

    // Dapatkan data monitoring kegiatan berdasarkan id_ormawa dan id proposal
    $monitoringKegiatan = MonitoringKegiatan::where('id_ormawa', $ormawa->id)
                                            ->where('id_proposal_kegiatan', $id)
                                            ->get();
    // dd($monitoringKegiatan);

    // Jika monitoringKegiatan kosong, dapatkan hanya jumlah_dana dari semua data monitoring kegiatan yang terkait dengan ormawa
    if ($monitoringKegiatan->isEmpty()) {
        $monitoringKegiatan = MonitoringKegiatan::select('id', 'jumlah_dana', 'id_ormawa')
                                                ->where('id_ormawa', $ormawa->id)
                                                ->get();
    } else {
        // Array untuk menyimpan data kegiatan pembayaran
        $kegiatanpembayaran = [];

        // Iterasi melalui setiap data monitoring kegiatan
        foreach ($monitoringKegiatan as $kegiatan) {
            // Dapatkan semua data kegiatan pembayaran berdasarkan id_monitoring_kegiatan yang sesuai
            $keteranganPembayaran = KeteranganPembayaran::where('id_monitoring_kegiatan', $kegiatan->id)->get();

            // Hitung total pembayaran
            $totalPembayaran = $keteranganPembayaran->sum('jumlah_pembayaran');
            // Hitung saldo
            $saldo = $kegiatan->jumlah_dana - $totalPembayaran;

            // Tambahkan saldo ke objek monitoring kegiatan
            $kegiatan->saldo = $saldo;

            // Tambahkan semua data kegiatan pembayaran ke dalam array
            $kegiatanpembayaran[$kegiatan->id] = $keteranganPembayaran;
        }
    }

    $data = [
        'proposalKegiatan' => $proposal,
        'monitoringKegiatan' => $monitoringKegiatan,
        'keteranganPembayaran' => isset($kegiatanpembayaran) ? $kegiatanpembayaran : []
    ];

    // Return view dengan data
    return view('Ormawa.UpdateOrmawa.updateKegiatan', $data);
}






public function updateKegiatan(Request $request)
{
    $user = Auth::user();
    $ormawa = $user->ormawa->first();

    if (!$ormawa) {
        return redirect()->back()->withErrors('Tidak ada data Ormawa ditemukan');
    }

    // Cek apakah monitoringKegiatan ada berdasarkan id_proposal_kegiatan
    $monitoringKegiatan = MonitoringKegiatan::where('id_proposal_kegiatan', $request->input('id_proposal_kegiatan'))->first();

    if (!$monitoringKegiatan) {
        // Buat catatan baru jika tidak ditemukan
        $monitoringKegiatan = new MonitoringKegiatan();
        $monitoringKegiatan->id_proposal_kegiatan = $request->input('id_proposal_kegiatan');
        $monitoringKegiatan->id_ormawa = $ormawa->id;
    }

    // Perbarui data monitoring
    $monitoringKegiatan->jumlah_dana = $request->input('jumlah-dana')[0];
    // Dapatkan total jumlah pembayaran untuk id_monitoring_kegiatan tertentu
    $totalPembayaran = DB::table('tbl_keterangan_pembayaran')
        ->select(DB::raw('SUM(jumlah_pembayaran) as total_pembayaran'))
        ->where('id_monitoring_kegiatan', $monitoringKegiatan->id)
        ->first();

    // Hitung saldo dengan mengurangkan total pembayaran dari jumlah dana
    $monitoringKegiatan->saldo = $monitoringKegiatan->jumlah_dana - $totalPembayaran->total_pembayaran;
    $monitoringKegiatan->catatan = $request->input('catatan');
    $monitoringKegiatan->parameter_keberhasilan = $request->input('kegiatan-status') == 'berhasil' ? 'berhasil' : 'tidak berhasil';
    $monitoringKegiatan->save();

    // Update payment details
    $paymentDetails = $request->input('jenis-pembayaran');
    if ($paymentDetails) {
        foreach ($paymentDetails as $index => $jenisPembayaran) {
            // Cek apakah data sudah ada di database
            $existingPayment = KeteranganPembayaran::where('id_monitoring_kegiatan', $monitoringKegiatan->id)
                ->where('jenis_pembayaran', $jenisPembayaran)
                ->first();

            if ($existingPayment) {
                // Update existing payment
                $existingPayment->jumlah_pembayaran = $request->input('jumlah-pembayaran')[$index];
                $existingPayment->tanggal_pembayaran = $request->input('tanggal-pembayaran')[$index];
                $existingPayment->save();
            } else {
                // Insert new payment
                KeteranganPembayaran::create([
                    'id_monitoring_kegiatan' => $monitoringKegiatan->id,
                    'jenis_pembayaran' => $jenisPembayaran,
                    'jumlah_pembayaran' => $request->input('jumlah-pembayaran')[$index],
                    'tanggal_pembayaran' => $request->input('tanggal-pembayaran')[$index],
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    // Return a success response
    return redirect()->back()->with('success', 'Kegiatan berhasil diperbarui');
}


}