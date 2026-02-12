<?php

use Illuminate\Support\Facades\Route;
use YourVendor\ContactForm\Controllers\Admin\AdminContactController;

/*
|--------------------------------------------------------------------------
| Contact Form – Admin Web Routes  (prefix: /admin)
|--------------------------------------------------------------------------
|
| These routes render the Blade admin dashboard.
| Protected by Laravel's built-in 'auth' middleware + the AdminRole middleware.
|
*/

Route::prefix('admin')
    ->name('contact-form.admin.')
    ->middleware(['web', 'auth', \YourVendor\ContactForm\Http\Middleware\AdminRole::class])
    ->group(function () {

        // Dashboard listing with filters
        Route::get('contact-submissions',
            [AdminContactController::class, 'index'])
            ->name('index');

        // View single submission (auto-marks as read)
        Route::get('contact-submissions/{id}',
            [AdminContactController::class, 'show'])
            ->name('show');

        // Soft-delete a submission
        Route::delete('contact-submissions/{id}',
            [AdminContactController::class, 'destroy'])
            ->name('destroy');

        // Mark submission as read
        Route::patch('contact-submissions/{id}/mark-read',
            [AdminContactController::class, 'markRead'])
            ->name('mark-read');
    });
