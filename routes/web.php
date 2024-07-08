<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Warehouse\CategoryController;


Route::name('user.')->prefix('user')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index');
});

Route::name('store.')->prefix('store')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [StoreController::class, 'index'])->name('index');
    Route::get('/{store}', [StoreController::class, 'show'])->name('show');
});

Route::name('category.')->prefix('category')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [CategoryController::class, 'index'])->name('index');
    Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});
