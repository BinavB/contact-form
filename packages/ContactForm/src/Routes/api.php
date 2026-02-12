<?php

use Illuminate\Support\Facades\Route;
use ContactForm\Http\Controllers\Api\AuthController;
use ContactForm\Http\Controllers\Api\ContactSubmissionController;

/*
|--------------------------------------------------------------------------
| Contact Form API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('api/contact-form')
    ->name('contact-form.api.')
    ->group(function () {

        // ── Auth endpoints ─────────────────────────────────────────────────
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');

        // ── JWT-protected routes ───────────────────────────────────────────
        Route::middleware('auth:api')->group(function () {

            // Auth actions
            Route::post('logout', [AuthController::class, 'logout'])->name('logout');
            Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
            Route::get('me', [AuthController::class, 'me'])->name('me');

            // Contact form – submit
            Route::post('submit', [ContactSubmissionController::class, 'store'])
                ->name('submit');

            // User's own submissions
            Route::prefix('my-submissions')->name('my-submissions.')->group(function () {
                Route::get('/', [ContactSubmissionController::class, 'mySubmissions'])
                    ->name('index');
                Route::get('{id}', [ContactSubmissionController::class, 'show'])
                    ->name('show');
            });
        });
    });
