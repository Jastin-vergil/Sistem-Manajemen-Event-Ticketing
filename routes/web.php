<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\PaymentController;
// Halaman utama langsung lempar ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ==========================================
// RUTE AUTENTIKASI (Pake URL /login standar)
// ==========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
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



Route::post('/payment/store', [PaymentController::class, 'store'])
    ->name('payment.store');