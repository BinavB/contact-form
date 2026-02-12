<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Contact Form routes
Route::get('/', [WebController::class, 'index'])->name('welcome');
Route::prefix('contact-form')->name('contact-form.')->group(function () {
    Route::get('/', [WebController::class, 'showForm'])->name('form');
    Route::post('/submit', [WebController::class, 'submitForm'])->name('submit');
});

// Authentication routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', [WebController::class, 'showLogin'])->name('login');
    Route::post('/login', [WebController::class, 'processLogin'])->name('login.process');
});

// Laravel default auth routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// Admin routes (protected by auth middleware)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/contact-submissions', [WebController::class, 'adminDashboard'])->name('dashboard');
    Route::post('/contact-submissions/{id}/mark-read', [WebController::class, 'markAsRead'])->name('mark-read');
    Route::delete('/contact-submissions/{id}', [WebController::class, 'deleteSubmission'])->name('delete');
});
