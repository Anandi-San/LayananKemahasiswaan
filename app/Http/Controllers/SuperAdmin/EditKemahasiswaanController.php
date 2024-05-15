<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Services\SuperAdmin\editKemahasiswaanService;
use Illuminate\Http\Request;

class EditKemahasiswaanController extends Controller
{
    protected $editKemahasiswaanService;

    public function __construct(editKemahasiswaanService $editKemahasiswaanService)
    {
        $this->editKemahasiswaanService = $editKemahasiswaanService;
    }

    public function index()
    {
        return $this->editKemahasiswaanService->index();
    }
    
    public function nonaktifkan(Request $request, $id)
    {
        // Panggil metode nonaktifkan pada service
        $this->editKemahasiswaanService->nonaktifkan($request, $id);
        
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('edit.kemahasiswaan')->with('success', 'Kemahasiswaan telah dinonaktifkan.');
    }

    public function store(Request $request)
    {   
        // dd($request);
        // Panggil metode store di dalam service untuk menyimpan data
        $this->editKemahasiswaanService->store($request);
        
        // Redirect ke halaman indeks dengan pesan sukses
        return redirect()->route('profil.kemahasiswaan')->with('success', 'Data kemahasiswaan telah berhasil ditambahkan.');
    }

    public function edit()
    {
        return $this->editKemahasiswaanService->edit();
    }

    public function indexHistory()
    {
        return $this->editKemahasiswaanService->indexHistory();
    }
    
}
