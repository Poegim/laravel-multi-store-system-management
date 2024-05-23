<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return redirect('dashboard');
});

Route::name('users.')->prefix('users')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
