<?php

namespace App\Http\Services\Kemahasiswaan;

use App\Models\MonitoringKegiatan;
use App\Models\Ormawa;
use App\Models\OrmawaPembina;
use App\Models\Pembina;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class OrmawaService {
    public function index()
    {
        $ormawaList = Ormawa::with(['ormawaPembina.pembina'])->get();
        // dd($ormawaList);
        
        return $ormawaList;
    }
    public function edit($id)
    {
        // Dapatkan data ormawa berdasarkan ID
        $ormawa = Ormawa::findOrFail($id);

        // Dapatkan data monitoring kegiatan berdasarkan ID ormawa
        $monitoringKegiatan = MonitoringKegiatan::where('id_ormawa', $id)->first();
        // dd($monitoringKegiatan);

        // Kirim data ormawa dan monitoring kegiatan ke halaman edit
        return view('Kemahasiswaan.ormawa.edit', compact('ormawa', 'monitoringKegiatan'));
    }

    public function update(Request $request, $id)
    {
        $ormawa = Ormawa::findOrFail($id);
        // dd($ormawa);

        // Validasi input
        $request->validate([
            'nama_ormawa' => 'required|string|max:255',
            'singkatan_ormawa' => 'required|string|max:10',
            'jenis_ormawa' => 'required|string|max:50',
            'jurusan' => 'required|string|max:100',
            'logo_ormawa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // dd($request->all());

        // Perbarui data ormawa dengan data yang diterima dari formulir
        $ormawa->nama_ormawa = $request->nama_ormawa;
        $ormawa->singkatan = $request->singkatan_ormawa;
        $ormawa->jenis_ormawa = $request->jenis_ormawa;
        $ormawa->jurusan = $request->jurusan;

        // Jika ada file gambar yang diunggah, simpan gambar baru
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
        } 
        
        // dd($ormawa);

        // Simpan perubahan
        $ormawa->save();
    // dd($id_proposal_kegiatan);

    // Simpan data ke tabel tbl_monitoring_kegiatan
    MonitoringKegiatan::create([
    'id_ormawa' => $ormawa->id, // Menggunakan id_ormawa dari objek $ormawa
    'jumlah_dana' => str_replace(['Rp ', '.'], '', $request->jumlah_dana), // Simpan nilai tanpa format Rupiah
]);

        return view('Kemahasiswaan.ormawa.edit', compact('ormawa'));
    }

    public function create()
    {
    $pembinas = Pembina::all();
    
    // Mengirim data pembina ke view
    return view('Kemahasiswaan.ormawa.store', ['pembinas' => $pembinas]);
    }

    // SERVICE
// SERVICE
public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'email' => 'required|string|email|max:255|unique:tbl_pengguna',
        'password' => 'required|string|min:8',
        'nama_ormawa' => 'required|string|max:255',
        'singkatan_ormawa' => 'required|string|max:10',
        'jenis_ormawa' => 'required|string|max:50',
        'pembina' => 'required|array', // Memastikan bahwa pembina yang dipilih adalah array
        'pembina.*' => 'integer', // Memastikan bahwa setiap elemen di dalam array adalah integer (ID pembina)
        'logo_ormawa' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date',
    ]);

    // Simpan data email dan password ke tabel pengguna
    $pengguna = new Pengguna;
    $pengguna->email = $request->email;
    $pengguna->password = bcrypt($request->password); // Anda mungkin perlu menggunakan fungsi hash yang sesuai
    $pengguna->role = 'Ormawa'; // Default value untuk role
    $pengguna->save();

    // Simpan data ormawa dengan id_pengguna yang baru saja dibuat
    $ormawa = new Ormawa;
    $ormawa->id_pengguna = $pengguna->id; // Mengaitkan id_pengguna baru
    $ormawa->nama_ormawa = $request->nama_ormawa;
    $ormawa->singkatan = $request->singkatan_ormawa;
    $ormawa->jenis_ormawa = $request->jenis_ormawa;
    $ormawa->jurusan = $request->jurusan;

    // Simpan gambar baru ke direktori public/ormawa
    if ($request->hasFile('logo_ormawa')) {
        $logo = $request->file('logo_ormawa');
        $logoPath = 'ormawa/'. $logo->getClientOriginalName();
        $logo->move(public_path('ormawa'), $logoPath);
        // Simpan path gambar baru
        $ormawa->logo_ormawa = $logoPath;
    }

    $ormawa->save();

    // Simpan hubungan antara ormawa dan pembina ke dalam tabel tbl_ormawa_pembina
    foreach ($request->pembina as $id_pembina) {
        $ormawaPembina = new OrmawaPembina;
        $ormawaPembina->id_ormawa = $ormawa->id;
        $ormawaPembina->id_pembina = $id_pembina;
        $ormawaPembina->tanggal_mulai = $request->tanggal_mulai;
        $ormawaPembina->tanggal_selesai = $request->tanggal_selesai;
        // Anda mungkin perlu mengganti nilai default dengan nilai yang sesuai
        $ormawaPembina->id_pengurus_ormawa = 1;
        $ormawaPembina->save();
    }

    return redirect()->route('editOrmawa.index');
}



    public function destroy(string $id)
    {
        // Cari ormawa berdasarkan ID
        $ormawa = Ormawa::findOrFail($id);
        
        // Lakukan soft delete
        $ormawa->delete();

        return redirect()->route('editOrmawa.index');
    }
}

