<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\Commerce\SaleController;
use App\Http\Controllers\Commerce\ExternalInvoiceController;
use App\Http\Controllers\Warehouse\BrandController;
use App\Http\Controllers\Warehouse\FeatureController;
use App\Http\Controllers\Warehouse\ProductController;
use App\Http\Controllers\Warehouse\CategoryController;
use App\Http\Controllers\Warehouse\ProductVariantController;

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
Route::name('product-variant.')->prefix('product-variant')->middleware(['auth'])->group(function () {
    Route::get('', [ProductVariantController::class, 'index'])->name('index');
    // Route::get('/create', [ProductVariantController::class, 'create'])->name('create');
    // Route::post('/store', [ProductVariantController::class, 'store'])->name('store');
    Route::get('/{product:slug}', [ProductVariantController::class, 'show'])->name('show');
    // Route::get('/{product:slug}/edit', [ProductVariantController::class, 'edit'])->name('edit');
    // Route::put('/{product:slug}/update', [ProductVariantController::class, 'update'])->name('update');
});

Route::name('feature.')->prefix('feature')->middleware(['auth'])->group(function () {
    Route::get('', [FeatureController::class, 'index'])->name('index');
    Route::get('/create', [FeatureController::class, 'create'])->name('create');
    Route::post('/store', [FeatureController::class, 'store'])->name('store');
    Route::get('/{feature:slug}', [FeatureController::class, 'show'])->name('show');
    Route::get('/{feature:slug}/edit', [FeatureController::class, 'edit'])->name('edit');
    Route::put('/{feature:slug}/update', [FeatureController::class, 'update'])->name('update');
});

Route::name('sale.')->prefix('sale')->middleware(['auth'])->group(function () {
    Route::get('/store/{store:id?}', [SaleController::class, 'index'])->name('index');
    Route::get('/store/{store}/create', [SaleController::class, 'create'])->name('create');
    Route::post('/store', [SaleController::class, 'store'])->name('store');
    Route::get('/show/{sale}', [SaleController::class, 'show'])->name('show');
    Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('edit');
    Route::put('/{sale}/update', [SaleController::class, 'update'])->name('update');
});

Route::name('external-invoice.')->prefix('external-invoice')->middleware(['auth'])->group(function () {
    Route::get('/store/{store:id?}', [ExternalInvoiceController::class, 'index'])->name('index');
    Route::get('/store/{store}/create', [ExternalInvoiceController::class, 'create'])->name('create');
    Route::post('/store', [ExternalInvoiceController::class, 'store'])->name('store');
    Route::get('/show/{external-invoice}', [ExternalInvoiceController::class, 'show'])->name('show');
    Route::get('/{external-invoice}/edit', [ExternalInvoiceController::class, 'edit'])->name('edit');
    Route::put('/{external-invoice}/update', [ExternalInvoiceController::class, 'update'])->name('update');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [GitHubController::class, 'index'])->name('dashboard');
});
