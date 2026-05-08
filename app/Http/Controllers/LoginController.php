<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Halaman Login
Route::get('/login', function () {
return view('Pages.login');
})->name('login');

// Proses Login (Tanpa Database)
Route::post('/login', function (Request $request) {
if ($request->email == 'jastin@gmail.com' && $request->password == 'admin123') {
session(['is_logged_in' => true]);
return redirect('/admin_dashboard');
}
return back()->with('error', 'Email/Password Salah!');
});

// Halaman Dashboard
Route::get('/admin_dashboard', function () {
if (!session('is_logged_in')) {
return redirect('/login');
}
return view('Pages.admin_dashboard');
})->name('admin_dashboard');

// Logout
Route::post('/logout', function () {
session()->forget('is_logged_in');
return redirect('/login');
});
