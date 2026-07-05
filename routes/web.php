<?php

use App\Http\Controllers\AdminParticipantController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\TiketController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/userdashboard', [DashboardController::class, 'index'])
    ->name('user.dashboard');

Route::get('/', function () {
    return redirect()->route('user.dashboard');
});

Route::resource('tiket', TiketController::class)
    ->except(['show'])
    ->names([
        'index' => 'admin.ticket.interface',
        'create' => 'admin.ticket.create_ticket',
        'store' => 'admin.ticket.store',
        'edit' => 'admin.ticket.edit_ticket',
        'update' => 'admin.ticket.update',
        'destroy' => 'admin.ticket.destroy',
    ]);

Route::resource('events', EventController::class)
    ->except(['show'])
    ->names([
        'index' => 'admin.event.index',
        'create' => 'admin.event.create',
        'store' => 'admin.event.store',
        'edit' => 'admin.event.edit',
        'update' => 'admin.event.update',
        'destroy' => 'admin.event.destroy',
    ]);

Route::resource('kategori', KategoriController::class)
    ->except(['show', 'create', 'edit'])
    ->names([
        'index' => 'admin.kategori.index',
        'store' => 'admin.kategori.store',
        'update' => 'admin.kategori.update',
        'destroy' => 'admin.kategori.destroy',
    ]);

Route::get('/transactionhistory', function () {
    return view('Pages.transaction_history');
})->name('transaction.history');
Route::get('/transaction/search', [PembayaranController::class, 'searchByEmail'])->name('transaction.search');

Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('admin.pembayaran.index');
Route::get('/pembayaran/{pembayaran}', [PembayaranController::class, 'show'])->name('admin.pembayaran.show');
Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('payment.store');
Route::post('/pembayaran/{pembayaran}/approve', [PembayaranController::class, 'approve'])->name('admin.pembayaran.approve');
Route::post('/pembayaran/{pembayaran}/reject', [PembayaranController::class, 'reject'])->name('admin.pembayaran.reject');
Route::delete('/pembayaran/{pembayaran}', [PembayaranController::class, 'destroy'])->name('admin.pembayaran.destroy');

Route::get('/ticket-form', [TiketController::class, 'ticketForm'])->name('ticket.form');

Route::get('/payment', function () {
    return view('Pages.payment');
})->name('payment');

Route::post('/payment.store', [PembayaranController::class, 'store'])
    ->name('payment.store');

Route::get('/admin/participants', [AdminParticipantController::class, 'index'])
    ->name('admin.participants');

Route::get('admin/event/{event}/participants', [EventController::class, 'showParticipants'])->name('admin.event.participants');