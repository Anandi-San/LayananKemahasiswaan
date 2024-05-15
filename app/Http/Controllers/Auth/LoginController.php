<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\LoginService;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {   
        $this->loginService = $loginService;
        $this->middleware(['guest']);
    }

    public function showLogin()
    {
        return $this->loginService->showLogin();
    }

    public function login(Request $request)
    {
        return $this->loginService->login($request);
    }

    public function logout()
    {
        return $this->loginService->logout();
    }
}