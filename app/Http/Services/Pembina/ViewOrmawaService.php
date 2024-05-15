<?php

namespace App\Http\Services\Pembina;

use App\Models\Pembina;
use Illuminate\Http\Request;
use App\Models\Ormawa;
use App\Models\OrmawaPembina;
use Illuminate\Support\Facades\Auth;

class ViewOrmawaService {

    public function index()
{
    // Langkah 1: Ambil ID pengguna yang sedang login
    $userId = Auth::user()->id;

    // Cari ID pembina berdasarkan ID pengg una dari tabel pembina
    $pembina = Pembina::where('id_pengguna', $userId)->first();
    // dd($pembina);

    // Jika tidak ada pembina terkait pengguna yang login, kembalikan array kosong
    if (!$pembina) {
        return [
            'ormawas' => [], // Jika tidak ada pembina, kembalikan array kosong
        ];
    }

    // Langkah 2: Ambil ID Ormawa dari tabel pivot OrmawaPembina berdasarkan ID pembina
    $ormawaIds = OrmawaPembina::where('id_pembina', $pembina->id)
        ->pluck('id_ormawa')
        ->toArray();

        // dd($ormawaIds);

    // Periksa apakah ada ID Ormawa yang didapatkan
    if (empty($ormawaIds)) {
        return [
            'ormawas' => [], // Jika tidak ada ID Ormawa, kembalikan array kosong
        ];
    }

    // Langkah 3: Ambil data Ormawa berdasarkan ID Ormawa
    $ormawas = Ormawa::whereIn('id', $ormawaIds)
    ->with([
        'pengurusOrmawa' => function ($query) {
            $query->select('id_ormawa', 'visi', 'misi');
        },
        'ormawaPembina' => function ($query) {
            $query->with([
                'pengajuanLegalitas' => function ($query) {
                    $query->with([
                        'skLegalitas' => function ($query) {
                            $query->with([
                                'proposalKegiatan' => function ($query) {
                                    $query->with('monitoringKegiatan');
                                }
                            ]);
                        }
                    ]);
                }
            ]);
        }
    ])
    ->get();
    // dd($ormawas);

    // selanjutnya itu harus dapat data monitoring kegiatan

    // Kembalikan data Ormawa
    return [
        'ormawas' => $ormawas,
    ];
}

    public function store()
    {
        $data = [
            'content' => 'ormawa/ViewOrmawa/store',
        ];
        return view('Ormawa/ViewOrmawa/store', $data);
    }
}
