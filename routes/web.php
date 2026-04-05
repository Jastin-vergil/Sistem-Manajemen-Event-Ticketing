<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListBarangController;
use App\Http\Controllers\ListEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/app', function () {
return view('app');
});
Route::get('/event-view', [EventController::class, 'Event_view']);
Route::get('/listevents/{id}/{nama}', [ListEventController::class, 'tampilkan']);

Route::get('listbarang/{id}/{nama}', [ListBarangController::class, 'tampilkan']);

Route::prefix('admin')->group(function (){

    Route::get('/dashboard', [DashboardController::class, 'index']); 

    Route::get('/users', function (){
        return 'Admin Users';
    });
});

// Route testing (bisa dihapus kalau sudah tidak dipakai)
Route::get('/user/{id}', function ($id){
    return 'User dengan ID ' . $id;
});