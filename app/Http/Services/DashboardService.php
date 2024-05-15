<?php

namespace App\Http\Services;

class DashboardService
{
    public function index($role)
    {
        switch ($role) {
            case 'Ormawa':
                return $this->Ormawa();

            case 'Pembina':
                return $this->Pembina();

            case 'Kemahasiswaan':
                return $this->Kemahasiswaan();

            case 'Superadmin':
                return $this->SuperAdmin();

            default:
                abort(404);
        }
    }

    public function Ormawa()
    {
        return view('Ormawa.index');
    }

    public function Pembina()
    {
        return view('dashboard.pembina');
    }

    public function kemahasiswaan()
    {
        return view('dashboard.kemahasiswaan');
    }

    public function superAdmin()
    {
        return view('dashboard.super_admin');
    }
}
