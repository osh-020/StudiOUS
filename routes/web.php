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

Route::get('/user/helpdesk', [TicketController::class, 'helpdesk'])->name('user.helpdesk');
Route::get('/user/helpdesk/faqs/{id}', [TicketController::class, 'faqDetail'])->name('user.helpdesk.faq');
Route::post('/chatbot/query', [App\Http\Controllers\ChatbotController::class, 'query'])->name('chatbot.query');
Route::post('/user/tickets', [TicketController::class, 'store'])->name('user.tickets.store');
Route::get('/announcement', [HomeController::class, 'announcement'])->name('announcement');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/services', [ServiceController::class, 'index'])->name('services');
        Route::get('/services/{type}', [ServiceController::class, 'create'])->name('services.create');
        Route::post('/services/{type}', [ServiceController::class, 'store'])->name('services.store');
        Route::get('/requests', [TicketController::class, 'requests'])->name('requests');
        Route::get('/requests/{id}', [TicketController::class, 'showRequest'])->name('requests.show');
        Route::post('/requests/{id}/cancel', [TicketController::class, 'cancelRequest'])->name('requests.cancel');
        Route::get('/tickets', [TicketController::class, 'index'])->name('tickets');
        Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
        Route::get('/history', [TicketController::class, 'history'])->name('history');
    });

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets');
        Route::get('/requests', [AdminController::class, 'requests'])->name('requests');
        Route::get('/requests/{id}', [AdminController::class, 'showRequest'])->name('requests.show');
        Route::post('/requests/{id}/status', [AdminController::class, 'updateRequestStatus'])->name('requests.updateStatus');
        Route::post('/requests/{id}/reject', [AdminController::class, 'rejectRequest'])->name('requests.reject');
        Route::post('/requests/{id}/accept', [AdminController::class, 'acceptCancellation'])->name('requests.accept');
        Route::get('/tickets/{id}', [AdminController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{id}/reply', [AdminController::class, 'reply'])->name('tickets.reply');
        Route::post('/tickets/{id}/status', [AdminController::class, 'updateStatus'])->name('tickets.updateStatus');
        Route::get('/faqs', [AdminController::class, 'faqs'])->name('faqs');
        Route::get('/faqs/create', [AdminController::class, 'createFaq'])->name('faqs.create');
        Route::post('/faqs', [AdminController::class, 'storeFaq'])->name('faqs.store');
        Route::get('/faqs/{faq}/edit', [AdminController::class, 'editFaq'])->name('faqs.edit');
        Route::patch('/faqs/{faq}', [AdminController::class, 'updateFaq'])->name('faqs.update');
        Route::delete('/faqs/{faq}', [AdminController::class, 'destroyFaq'])->name('faqs.destroy');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
        Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/announcement', [AdminController::class, 'announcement'])->name('announcement');
        Route::get('/announcement/{announcement}/edit', [AdminController::class, 'editAnnouncement'])->name('announcement.edit');
        Route::patch('/announcement/{announcement}', [AdminController::class, 'updateAnnouncement'])->name('announcement.update');
        Route::post('/announcement', [AdminController::class, 'storeAnnouncement'])->name('announcement.store');
        Route::delete('/announcement/{announcement}', [AdminController::class, 'destroyAnnouncement'])->name('announcement.destroy');
    });
});
