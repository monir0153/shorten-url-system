<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/dashboard', [UrlController::class, 'stats'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(UrlController::class)->group(function () {
    Route::get('/',  'index');
    Route::post('/short-url',  'shortenUrl')->name('shorten.url');
    Route::get('/url', 'redirectUrl')->name('redirect');
});

route::get('/short-url', [UrlController::class, 'shortenUrl']);

require __DIR__ . '/auth.php';
