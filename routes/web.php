<?php

use App\Http\Controllers\GitHubController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Warehouse\BrandController;
use App\Http\Controllers\Warehouse\CategoryController;
use App\Http\Controllers\Warehouse\ProductController;

Route::name('user.')->prefix('user')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index');
});

Route::name('store.')->prefix('store')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [StoreController::class, 'index'])->name('index');
    Route::get('/create', [StoreController::class, 'create'])->name('create');
    Route::post('/store', [StoreController::class, 'store'])->name('store');
    Route::get('/{store}', [StoreController::class, 'show'])->name('show');
    Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('edit');
    Route::put('/{store}/update', [StoreController::class, 'update'])->name('update');
});

Route::name('category.')->prefix('category')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [CategoryController::class, 'index'])->name('index');
    Route::get('/create', [CategoryController::class, 'create'])->name('create');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::get('/{category:slug}', [CategoryController::class, 'show'])->name('show');
    Route::get('/{category:slug}/edit', [CategoryController::class, 'edit'])->name('edit');
    Route::put('/{category:slug}/update', [CategoryController::class, 'update'])->name('update');
});

Route::name('brand.')->prefix('brand')->middleware(['auth'])->group(function () {
    Route::get('', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/store', [BrandController::class, 'store'])->name('store');
    Route::get('/{brand:slug}', [BrandController::class, 'show'])->name('show');
    Route::get('/{brand:slug}/edit', [BrandController::class, 'edit'])->name('edit');
    Route::put('/{brand:slug}/update', [BrandController::class, 'update'])->name('update');
});

Route::name('product.')->prefix('product')->middleware(['auth'])->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/{product:slug}', [ProductController::class, 'show'])->name('show');
    Route::get('/{product:slug}/edit', [ProductController::class, 'edit'])->name('edit');
    Route::put('/{product:slug}/update', [ProductController::class, 'update'])->name('update');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [GitHubController::class, 'index'])->name('dashboard');
});
