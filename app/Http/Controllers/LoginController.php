<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Bagian Auth::check() yang melempar otomatis sudah dibuang total!
        return view('admin.login');
    }

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

            return redirect()->route('admin.ticket.interface');
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