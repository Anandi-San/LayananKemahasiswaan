<?php

namespace App\Http\Controllers\Ormawa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Ormawa\UpdateDataOrmawa;


class UpdateDataOrmawaController extends Controller
{
    private $updateDataOrmawa;

    public function __construct(UpdateDataOrmawa $updateDataOrmawa)
    {
        $this->updateDataOrmawa = $updateDataOrmawa;
    }

    public function index()
    {
        $profil = $this->updateDataOrmawa->index()->first();
        // dd($profil);

        return view('Ormawa/UpdateOrmawa/updateDetail', compact('profil'));
    }

    public function updateOrmawa(Request $request)
    {
        $updateService = new UpdateDataOrmawa();
        $updateService->updateOrmawa($request);

        return redirect()->route('ormawa.update');
    }

    public function indexKepengurusan()
    {
        $pengurusOrmawa = $this->updateDataOrmawa->indexKepengurusan();
        // dd($ormawa);

        return view('Ormawa/UpdateOrmawa/updateKepengurusan', compact('pengurusOrmawa'));
    }

        public function updateKepengurusan(Request $request)
    {
        // Meneruskan objek Request ke metode updateKepengurusan
        return $this->updateDataOrmawa->updateKepengurusan($request);
    }

        public function indexKegiatan()
    {
        // Meneruskan objek Request ke metode updateKepengurusan
        return $this->updateDataOrmawa->indexKegiatan();
    }

    public function editKegiatan($id)
    {
    // Panggil fungsi editKegiatan dari service
        return $this->updateDataOrmawa->editKegiatan($id);
        // dd($data);

        // Return view dengan data yang diteruskan
        // return view('Ormawa/UpdateOrmawa/updateKegiatan', compact('data'));

    }
    public function updateKegiatan(Request $request)
    {
    return $this->updateDataOrmawa->updateKegiatan($request);
    }
}