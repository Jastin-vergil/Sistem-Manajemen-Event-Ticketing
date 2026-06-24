<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]
        ,[
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        $admin = User::where('email', $request->email)
            ->where('password', $request->password)
            ->first();

        if ($admin) {
            Auth::loginUsingId($admin->id);
            $request->session()->regenerate();

            return redirect()->route('admin.ticket.interface');
        }

        return back()->with('error', 'Your Email or Password Is Wrong.');
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
