<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/announcement', [HomeController::class, 'announcement'])->name('announcement');
    Route::get('/about', [HomeController::class, 'about'])->name('about');

    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/helpdesk', [TicketController::class, 'helpdesk'])->name('helpdesk');
        Route::get('/helpdesk/faqs/{id}', [TicketController::class, 'faqDetail'])->name('helpdesk.faq');
        Route::get('/services', [ServiceController::class, 'index'])->name('services');
        Route::get('/services/{type}', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services/{type}', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
        Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    });

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets');
        Route::get('/tickets/{id}', [AdminController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{id}/reply', [AdminController::class, 'reply'])->name('tickets.reply');
        Route::post('/tickets/{id}/status', [AdminController::class, 'updateStatus'])->name('tickets.updateStatus');
    });
});
