<?php

namespace App\Http\Services\Guest;

use App\Models\Pengguna;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ForgetPasswordService
{
    public function index()
    {
        return view('Guest.LupaPassword.index');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:tbl_pengguna,email']);

        $status = Password::broker('tbl_pengguna')->sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? ['status' => $status]
            : ['error' => $status];
    }

    public function resetPassword(Request $request)
    {
        // dd($request);

        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (Pengguna $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );
        return $status;
    }
}
