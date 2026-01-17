<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CatController;

Route::prefix('cats')->group(function () {

    Route::get('/', [CatController::class, 'index'])
        ->name('admin.cats.index');
    
    Route::get('/create', [CatController::class, 'create']) ->name('admin.cats.create');    

    Route::post('/addcat', [CatController::class, 'store'])
        ->name('admin.cats.store');


    Route::get('/edit/{id}', [CatController::class, 'edit'])
        ->name('admin.cats.edit');


    Route::put('/update/{id}', [CatController::class, 'update'])
        ->name('admin.cats.update');

    Route::delete('/{id}', [CatController::class, 'destroy'])
        ->name('admin.cats.destroy');
});
