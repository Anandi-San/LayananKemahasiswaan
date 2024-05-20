<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Services\Guest\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterService $registerService)
    {   
        $this->registerService = $registerService;
        $this->middleware(['guest']);
    }

    public function index()
    {
        return $this->registerService->index();
    }
    public function store(Request $request)
    {
        return $this->registerService->store($request);
    }
}
