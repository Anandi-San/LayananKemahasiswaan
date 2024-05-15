<?php

namespace App\Http\Services\SuperAdmin;

use App\Models\SuperAdmin;

Class BerandaService {
    public function getSuperAdminByUserId($userId)
    {
        return SuperAdmin::where('id_pengguna', $userId)->first();
    }
}
    