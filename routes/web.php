<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AdminController;

Route::middleware('auth')->group(function () {
    Route::post('/tickets/buy', [TicketController::class, 'buy'])->name('tickets.buy');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::get('/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
});
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {
    Route::get('/tickets/buy', [TicketController::class, 'showBuy'])->name('tickets.buy');
    Route::post('/tickets/buy', [TicketController::class, 'buy']);
});
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/skates/create', [AdminController::class, 'createSkate'])->name('admin.skates.create');
    Route::post('/admin/skates', [AdminController::class, 'storeSkate'])->name('admin.skates.store');
    Route::get('/admin/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
    Route::get('/admin/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
});