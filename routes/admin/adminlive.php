<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;

Route::prefix('admin')
    ->middleware(['auth']) // protect with auth
    ->group(function () {
        // Livewire-based dashboard
        Route::get('/dashboard-live', Dashboard::class)
            ->name('admin.dashboard.live');

        // Include livewire cat routes
        require __DIR__ . '/livewire/cat.php';
    });
