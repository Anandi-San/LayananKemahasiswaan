<?php

namespace App\Http\Services;

use Illuminate\Http\Request;

class LandingPageService {

    public function index(){
        $data = [
            'content' => 'home/beranda/index'
        ];
        return view('beranda');
    }
}