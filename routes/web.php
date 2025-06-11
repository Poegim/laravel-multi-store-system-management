<?php

use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Commerce\ExternalInvoice;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Commerce\SaleController;
use App\Http\Controllers\Warehouse\BrandController;
use App\Http\Controllers\Warehouse\ColorController;
use App\Http\Controllers\Warehouse\FeatureController;
use App\Http\Controllers\Warehouse\ProductController;
use App\Http\Controllers\Warehouse\CategoryController;
use App\Http\Controllers\Warehouse\StockItemController;
use App\Http\Controllers\Commerce\ExternalInvoiceController;
use App\Http\Controllers\Warehouse\ProductVariantController;

Route::name('user.')->prefix('user')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [UserController::class, 'index'])->name('index');
});

Route::name('store.')->prefix('store')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('', [StoreController::class, 'index'])->name('index');
    Route::get('/create', [StoreController::class, 'create'])->name('create');
    Route::post('/store', [StoreController::class, 'store'])->name('store');
    Route::get('/show/{store}', [StoreController::class, 'show'])->name('show');
    Route::get('/edit/{store}', [StoreController::class, 'edit'])->name('edit');
    Route::put('/update/{store}', [StoreController::class, 'update'])->name('update');
});

Route::name('stock.')->prefix('stock')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('{store?}', [StockItemController::class, 'index'])->name('index');
    Route::get('/create', [StockItemController::class, 'create'])->name('create');
    Route::post('/store', [StockItemController::class, 'store'])->name('store');
    Route::get('/show/{stock}', [StockItemController::class, 'show'])->name('show');
    Route::get('/edit/{stock}', [StockItemController::class, 'edit'])->name('edit');
    Route::put('/update/{stock}', [StockItemController::class, 'update'])->name('update');
});

Route::prefix('repository')->group(function () {
    Route::name('category.')->prefix('category')->middleware(['auth', IsAdmin::class])->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/show/{category:slug}', [CategoryController::class, 'show'])->name('show');
        Route::get('/edit/{category:slug}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update{category:slug}', [CategoryController::class, 'update'])->name('update');
    });
});



Route::name('brand.')->prefix('brand')->middleware(['auth'])->group(function () {
    Route::get('', [BrandController::class, 'index'])->name('index');
    Route::get('/create', [BrandController::class, 'create'])->name('create');
    Route::post('/store', [BrandController::class, 'store'])->name('store');
    Route::get('/show/{brand:slug}', [BrandController::class, 'show'])->name('show');
    Route::get('/edit/{brand:slug}', [BrandController::class, 'edit'])->name('edit');
    Route::put('/update/{brand:slug}', [BrandController::class, 'update'])->name('update');
});

Route::name('product.')->prefix('product')->middleware(['auth'])->group(function () {
    Route::get('', [ProductController::class, 'index'])->name('index');
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/show/{brand:slug}/{product:slug}', [ProductController::class, 'show'])->name('show');
    Route::get('/edit/{product:id}/', [ProductController::class, 'edit'])->name('edit');
    Route::put('/update/{product:id}', [ProductController::class, 'update'])->name('update');
});
Route::name('product-variant.')->prefix('product-variant')->middleware(['auth'])->group(function () {
    Route::get('', [ProductVariantController::class, 'index'])->name('index');
    Route::get('/create', [ProductVariantController::class, 'create'])->name('create');
    Route::post('/store', [ProductVariantController::class, 'store'])->name('store');
    Route::get('/{product_variant:id}/show', [ProductVariantController::class, 'show'])->name('show');
    Route::get('/{product_variant:id}/edit', [ProductVariantController::class, 'edit'])->name('edit');
    Route::put('/{product_variant}/update', [ProductVariantController::class, 'update'])->name('update');
});

Route::name('feature.')->prefix('feature')->middleware(['auth'])->group(function () {
    Route::get('', [FeatureController::class, 'index'])->name('index');
    Route::get('/create', [FeatureController::class, 'create'])->name('create');
    Route::post('/store', [FeatureController::class, 'store'])->name('store');
    Route::get('/show/{feature:slug}', [FeatureController::class, 'show'])->name('show');
    Route::get('/edit/{feature:slug}', [FeatureController::class, 'edit'])->name('edit');
    Route::put('/update/{feature:slug}', [FeatureController::class, 'update'])->name('update');
});

Route::name('sale.')->prefix('sale')->middleware(['auth'])->group(function () {
    Route::get('/{store:id?}', [SaleController::class, 'index'])->name('index');
    Route::get('/{store:id}/create', [SaleController::class, 'create'])->name('create');
    Route::post('/store', [SaleController::class, 'store'])->name('store');
    Route::get('/show/{sale}', [SaleController::class, 'show'])->name('show');
    Route::get('/edit/{sale}', [SaleController::class, 'edit'])->name('edit');
    Route::put('/update/{sale}', [SaleController::class, 'update'])->name('update');
});

Route::name('external-invoice.')->prefix('external_invoice')->middleware(['auth'])->group(function () {
    Route::get('/store/{store:id?}', [ExternalInvoiceController::class, 'index'])->name('index');
    Route::get('/{store:id}/create', [ExternalInvoiceController::class, 'create'])->name('create');
    Route::post('/{store:id}/store', [ExternalInvoiceController::class, 'store'])->name('store');
    Route::get('/show/{external_invoice:id}', [ExternalInvoiceController::class, 'show'])->name('show');
    Route::get('/edit/{external_invoice:id}', [ExternalInvoiceController::class, 'edit'])->name('edit');
    Route::put('/update/{external_invoice}', [ExternalInvoiceController::class, 'update'])->name('update');
});

Route::name('contact.')->prefix('contact')->middleware(['auth'])->group(function () {
    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::get('/create', [ContactController::class, 'create'])->name('create');
    Route::post('/store', [ContactController::class, 'store'])->name('store');
    Route::get('/{contact}/show', [ContactController::class, 'show'])->name('show');
    Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('edit');
    Route::put('/{contact}/update', [ContactController::class, 'update'])->name('update');
});


Route::name('color.')->prefix('color')->middleware(['auth'])->group(function () {
    Route::get('/', [ColorController::class, 'index'])->name('index');
    Route::get('/create', [ColorController::class, 'create'])->name('create');
    Route::post('/store', [ColorController::class, 'store'])->name('store');
    Route::get('/edit/{color}', [ColorController::class, 'edit'])->name('edit');
    Route::put('/update/{color}', [ColorController::class, 'update'])->name('update');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', [GitHubController::class, 'index'])->name('dashboard');
});
