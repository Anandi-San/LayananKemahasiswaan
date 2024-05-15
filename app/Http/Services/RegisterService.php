<?php

namespace App\Http\Services;

use App\Register;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

Class RegisterService {

    public function index() {
       $register = Register::latest()->get();

    }

    public function store(Request $request) {
        $registerValid = $request->validate([
            "email_pengguna" => "required",
            "nama_ormawa" => "required",
            "jenis_ormawa" => "in:Eksekutif,Legislatif,UKM",
            "nama_dosen_pembina" => "required",
            "nomor_telepon_PIC"
        ]);

        $register = Register::create($registerValid);

        return $register;
    }

}