<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Services\Guest\ForgetPasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgetPasswordController extends Controller
{
    private $forgetPasswordService;

    public function __construct(ForgetPasswordService $forgetPasswordService)
    {
        $this->forgetPasswordService = $forgetPasswordService;
        $this->middleware(['guest']);
    }

    public function index()
    {
        return $this->forgetPasswordService->index();
    }

    public function sendResetLink(Request $request)
    {
        $response = $this->forgetPasswordService->sendResetLink($request);

        if (isset($response['status'])) {
            return back()->with(['status' => __($response['status'])]);
        } else {
            return back()->withErrors(['email' => __($response['error'])]);
        }
    }

    public function resetPassword(Request $request)
    {
        $status = $this->forgetPasswordService->resetPassword($request);

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with(['status' => __('Password has been reset successfully.')]);
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }
}
