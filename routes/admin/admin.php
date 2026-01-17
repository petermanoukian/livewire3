<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;

Route::prefix('admin')
    ->middleware(['auth']) // protect with auth
    ->group(function () {
        // Blade-based dashboard
        Route::get('/dashboard', [HomeController::class, 'index'])
            ->name('admin.dashboard');

        // Include classic cat routes
        require __DIR__ . '/classic/cat.php';
    });

