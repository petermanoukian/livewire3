<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\TestFullPage;


Route::get('/clear', function () {
    $exitCode = \Artisan::call('config:cache');
    $exitCode = \Artisan::call('cache:clear');
    $exitCode = \Artisan::call('route:clear');
    $exitCode = \Artisan::call('view:clear');
    $exitCode = \Artisan::call('config:clear');

    return '<h1>Clear Config cleared</h1>';
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logoutget');


Route::get('/test-full-page', TestFullPage::class);

require __DIR__.'/auth.php';
require __DIR__.'/admin/admin.php';
require __DIR__.'/admin/adminlive.php';

