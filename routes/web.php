<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\ListEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\dashboard_pengunjung;
use App\Http\Controllers\ProductController;// Pindahkan ke sini

// --- Public Routes ---
Route::get('/login', function () {
    return view('login');
});
Route::get('/dashboard', function () {
    return view('user_dashboard');
});
Route::get('/navbar', function () {
    return view('partials.navbar');
});
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/list_product', function () {
    return view('list_product');
});
Route::get('/app', function () {
    return view('app');
});
Route::get('/landingpage', function () {
    return view('landing_page');
});
Route::get('/admindashboard', function () {
    return view('admin_dashboard');
});
Route::get('/informasipembayaran', function () {
    return view('informasi_pembayaran');
});
Route::get('/ticket', function () {
    return view('ticket');
})->name('ticket');
Route::get('/payment', function () {
    return view('payment');
})->name('payment');
Route::post('/payment/confirm', function () {
    return "Payment Success (dummy)";
})->name('payment.confirm');


Route::get('/list_product', [ProductController::class, 'index']);
