<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\ListEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\dashboard_pengunjung;// Pindahkan ke sini

// --- Public Routes ---
Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/navbar', [IndexController::class, 'index']);
Route::get('/login', function () {
    return view('login');
});
Route::get('/dashboard_pengunjung', function () {
    return view('dashboard_pengunjung');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('app');
});

// --- Event & Barang Routes ---
Route::get('/event-view', [EventController::class, 'Event_view']);
Route::get('/listevents/{id}/{nama}', [ListEventController::class, 'tampilkan']);
Route::get('listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);

// --- Admin Routes ---
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']); 
    Route::get('/users', function () {
        return 'Admin Users';
    });
});

// --- Testing Routes ---
Route::get('/user/{id}', function ($id) {
    return 'User dengan ID ' . $id;
});