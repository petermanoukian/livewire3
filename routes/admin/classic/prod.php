<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProdController;

Route::prefix('prods')->group(function () {
    Route::get('/view/{catid?}/{subcatid?}', [ProdController::class, 'index'])
        ->name('admin.prods.index');
});
