<?php

namespace App\Http\Services;

use App\Models\Pembina;

Class PembinaService {
    public function getPembinaByUserId($userId)
    {
        return Pembina::where('id_pengguna', $userId)->first();
    }
}
    