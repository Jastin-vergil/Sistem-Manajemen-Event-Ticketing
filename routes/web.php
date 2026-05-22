<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardAdminController;

// --- Public Routes ---
Route::get('/login', function () {
    return view('Pages.login');
});
Route::get('/transactionhistory', function () {
    return view('Pages.transaction_history');
});
Route::get('/userdashboard', function () {
    return view('Pages.landing_page');
});
Route::get('/admindashboard', function () {
    return view('Pages.admin_dashboard');
});
Route::get('/informasipembayaran', function () {
    return view('Pages.informasi_pembayaran');
});
Route::get('/categories', function () {
    return view('Pages.categories');
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


// untuk login admin dan akun dummy
Route::get('/login', function () {
    return view('Pages.login');
})->name('login');

Route::post('/login', function (Illuminate\Http\Request $request) {
    if ($request->email == 'jastin@gmail.com' && $request->password == 'admin123') {
        session(['is_logged_in' => true]);
        return redirect('/admin_dashboard');
    }
    return back()->with('error', 'Silahkan masukkan email dan password yang benar!');
});

Route::get('/admin_dashboard', function () {
    if (!session('is_logged_in')) return redirect('/login');
    return view('Pages.admin_dashboard');
})->name('admin_dashboard');

Route::get('/admindashboard', [DashboardAdminController::class, 'index']);

Route::post('/events', [DashboardAdminController::class, 'store']);

Route::put('/events/{id}', [DashboardAdminController::class, 'update']);

Route::delete('/events/{id}', [DashboardAdminController::class, 'destroy']);
