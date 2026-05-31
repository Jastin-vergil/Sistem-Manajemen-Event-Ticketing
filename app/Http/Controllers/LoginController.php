<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        // Jika admin sudah login sebelumnya, langsung lempar ke dashboard
        if (Auth::check()) {
            return redirect()->intended('/admindashboard');
        }

        return view('admin.login');
    }

    // Memproses data input login tanpa Bcrypt (Teks Biasa)
    public function login(Request $request)
    {
        // 1. Validasi input form
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cari data admin di tabel admin_event berdasarkan email dan password teks biasa
        $admin = User::where('email', $request->email)
                     ->where('password', $request->password)
                     ->first();

        // 3. Jika data ditemukan, buat session login secara manual
        if ($admin) {
            Auth::login($admin);
            $request->session()->regenerate();

            // Berhasil login, masuk ke dashboard admin
            return redirect()->intended('/admindashboard');
        }

        // 4. Jika tidak cocok, kembali ke halaman login dengan pesan kesalahan
        return back()->with('error', 'Email atau password salah.');
    }

    // Mengakhiri session login (Logout)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
