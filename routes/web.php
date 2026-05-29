<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PaymentController;

// --- Public Routes ---
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/transactionhistory', function () {
    return view('Pages.transaction_history');
});
Route::get('/userdashboard', function () {
    return view('Pages.landing_page');
});
Route::get('/admindashboard', [DashboardAdminController::class, 'index'])->name('admin.admin_dashboard');
Route::get('/informasipembayaran', function () {
    return view('admin.informasi_pembayaran');
});
Route::get('/categories', function () {
    return view('admin.categories');
});
Route::get('/ticket', function () {
    return view('Pages.ticket');
})->name('ticket');

Route::get('/payment', function () {
    return view('Pages.payment');
})->name('payment');

Route::post('/payment/confirm', function () {
    return "Payment Success (dummy)";
})->name('payment.confirm');

Route::get('/admindashboard', [DashboardAdminController::class, 'index']);

Route::post('/events', [DashboardAdminController::class, 'store']);

Route::put('/events/{id}', [DashboardAdminController::class, 'update']);

Route::delete('/events/{id}', [DashboardAdminController::class, 'destroy']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route untuk Halaman Dashboard Admin
Route::get('/pages/admin_dashboard', function () {
    // Cek manual: Jika belum login ATAU bukan admin, tendang balik ke halaman login
    if (!Auth::check() || !Auth::user()->is_admin) {
        return redirect('/login')->withErrors(['email' => 'Silahkan login sebagai admin terlebih dahulu.']);
    }

    return view('admin.admin_dashboard');
})->name('admin.admin_dashboard');

Route::post('/payment/store', [PaymentController::class, 'store'])
    ->name('payment.store');