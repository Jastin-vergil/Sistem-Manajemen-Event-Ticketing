<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\ListEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\dashboard_pengunjung;
use App\Http\Controllers\informasipembayaranController;
use App\Http\Controllers\ProductController;// Pindahkan ke sini

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
