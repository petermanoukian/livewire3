<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SubcatController;

Route::prefix('subcats')->group(function () {
    Route::get('/view/{catid?}', [SubcatController::class, 'index'])
        ->name('admin.subcats.index');
});
