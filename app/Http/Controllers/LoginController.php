<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Tampilkan Form Login (Form akan TETAP muncul meskipun admin sudah login)
    public function showLoginForm()
    {
        // Bagian Auth::check() yang melempar otomatis sudah dibuang total!
        return view('admin.login');
    }

    // Memproses data input login tanpa Bcrypt
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Cari data admin menggunakan plain text password
        $admin = User::where('email', $request->email)
                     ->where('password', $request->password)
                     ->first();

        if ($admin) {
            Auth::loginUsingId($admin->id);
            $request->session()->regenerate();

            return redirect()->route('admin.ticket.index');
        }

        return back()->with('error', 'Email atDau password salah.');
    }

    // Proses Log Out Hancurkan Session
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
