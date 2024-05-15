<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\SuperAdmin\BerandaService;


class BerandaSuperAdminController extends Controller
{
    protected $berandaService;

    public function __construct(berandaService $berandaService)
    {
        $this->berandaService = $berandaService;
    }

    public function index()
    {
        $userId = Auth::id();
        $superadmin = $this->berandaService->getSuperAdminByUserId($userId);

        return view('SuperAdmin.index', compact('superadmin'));
    }
}
