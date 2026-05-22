<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        //Validasi input login
        validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials['is_admin'] = true;

        // eksekusi login
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            // redirect ke halaman admin dashboard
            return redirect()->intended('admindashboard');
        }

        // kalau gagal login, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'email' => 'Akses ditolak. Email atau password salah, atau akun kamu bukan Admin.',
        ])->onlyInput('email');
    }
}
