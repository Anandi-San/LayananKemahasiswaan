<?php

namespace App\Http\Services\Guest;

use App\Models\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Class RegisterService {

    public function index() {
        return view ('Guest.Register.index');
    }

    public function store(Request $request) {
        $registerValid = $request->validate([
            "email_pengguna" => "required",
            "nama_ormawa" => "required",
            "jenis_ormawa" => "in:Eksekutif,Legislatif,UKM",
            "nama_dosen_pembina" => "required",
            "nomor_telepon_PIC" => "required",
            "jurusan" => 'required'
        ]);
        // dd($registerValid);

        $register = Register::create($registerValid);

        return view('login', compact('register'));
    }

}