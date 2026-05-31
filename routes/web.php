<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TiketController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/userdashboard', function () {
    return view('Pages.landing_page');
});

Route::get('/', function () {
    return redirect()->route('admin.ticket.interface');
});

Route::resource('tiket', TiketController::class)
    ->except(['show'])
    ->names([
        'index'   => 'admin.ticket.interface',
        'create'  => 'admin.ticket.create_ticket',
        'store'   => 'admin.ticket.store',
        'edit'    => 'admin.ticket.edit_ticket',
        'update'  => 'admin.ticket.update',
        'destroy' => 'admin.ticket.destroy',
    ]);

Route::resource('events', EventController::class)
    ->except(['show'])
    ->names([
        'index'   => 'admin.event.index',
        'create'  => 'admin.event.create',
        'store'   => 'admin.event.store',
        'edit'    => 'admin.event.edit',
        'update'  => 'admin.event.update',
        'destroy' => 'admin.event.destroy',
    ]);

    use App\Http\Controllers\KategoriController;

Route::resource('kategori', KategoriController::class)
    ->except(['show', 'create', 'edit'])
    ->names([
        'index'   => 'admin.kategori.index',
        'store'   => 'admin.kategori.store',
        'update'  => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
Route::get('/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('admin.pembayaran.show');
Route::post('/pembayaran/{pembayaran}/approve', [PembayaranController::class, 'approve'])->name('admin.pembayaran.approve');
Route::post('/pembayaran/{pembayaran}/reject', [PembayaranController::class, 'reject'])->name('admin.pembayaran.reject');
Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');
