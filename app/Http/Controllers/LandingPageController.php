<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\LandingPageService;


class LandingPageController extends Controller
{
    private $landingPageService;

    public function __construct(LandingPageService $landingPageService)
    {
        $this->landingPageService = $landingPageService;
    }

    public function index()
    {
        return $this->landingPageService->index();
    }
}
