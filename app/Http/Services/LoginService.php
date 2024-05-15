<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginService {

    public function showLogin() {
        return view('login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string']
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            if ($user->role === 'Ormawa') {
                $user->load(['ormawa', 'pengurusOrmawa', 'ormawaPembina']);
            } elseif ($user->role === 'Pembina') {
                $user->load(['pembina', 'ormawaPembina']);
            } elseif ($user->role === 'Kemahasiswaan') {
                $user->load(['kemahasiswaan']);
            } else {
                $user->load(['SuperAdmin']);
            }

            return redirect()->route('login')->with('user', $user);
        }

        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['email' => 'Login failed. Please check your email and password.']);
    }

    public function logout() {
        Auth::logout();

        return redirect()->route('/');
    }
}