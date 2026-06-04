<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\KategoriController;

use App\Models\Event;
use App\Models\Kategori;
use App\Http\Controllers\AdminParticipantController;
use App\Http\Controllers\DashboardController;


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/userdashboard', [DashboardController::class, 'index'])
    ->name('user.dashboard');

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


Route::resource('kategori', KategoriController::class)
    ->except(['show', 'create', 'edit'])
    ->names([
        'index'   => 'admin.kategori.index',
        'store'   => 'admin.kategori.store',
        'update'  => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);

route::get('/transactionhistory', function () {
    return view('Pages.transaction_history');
})->name('transaction.history');

Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
Route::get('/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('admin.pembayaran.show');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('payment.store');
Route::post('/pembayaran/{pembayaran}/approve', [PembayaranController::class, 'approve'])->name('admin.pembayaran.approve');
Route::post('/pembayaran/{pembayaran}/reject', [PembayaranController::class, 'reject'])->name('admin.pembayaran.reject');
Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');

Route::get('/ticket-form', function () {
    return view('Pages.ticket');
})->name('ticket.form');

Route::get('/payment', function () {
    return view('Pages.payment');
})->name('payment');

Route::post('/payment.store', [PembayaranController::class, 'store'])
    ->name('payment.store');

Route::get('/admin/participants', [AdminParticipantController::class, 'index'])
    ->name('admin.participants');