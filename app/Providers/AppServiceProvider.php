<?php

namespace App\Providers;

use App\Models\Commerce\ExternalInvoice;
use App\Models\User;
use App\Policies\UserPolicy;
use App\Services\BrandService;
use App\Services\StoreService;
use App\Services\ContactService;
use App\Services\FeatureService;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Services\ProductVariantService;
use Illuminate\Support\ServiceProvider;
use App\Services\ExternalInvoiceService;
use App\Repositories\BrandRepository\BrandRepository;
use App\Repositories\StoreRepository\StoreRepository;
use App\Repositories\ContactRepository\ContactRepository;
use App\Repositories\FeatureRepository\FeatureRepository;
use App\Repositories\ProductRepository\ProductRepository;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Repositories\BrandRepository\BrandRepositoryInterface;
use App\Repositories\StoreRepository\StoreRepositoryInterface;
use App\Repositories\ContactRepository\ContactRepositoryInterface;
use App\Repositories\FeatureRepository\FeatureRepositoryInterface;
use App\Repositories\ProductRepository\ProductRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Repositories\ProductVariantRepository\ProductVariantRepository;
use App\Repositories\ExternalInvoiceRepository\ExternalInvoiceRepository;
use App\Repositories\ProductVariantRepository\ProductVariantRepositoryInterface;
use App\Repositories\ExternalInvoiceRepository\ExternalInvoiceRepositoryInterface;
use App\Repositories\TemporaryExternalInvoiceItemRepository\TemporaryExternalInvoiceItemRepository;
use App\Repositories\TemporaryExternalInvoiceItemRepository\TemporaryExternalInvoiceItemRepositoryInterface;
use App\Services\TemporaryExternalInvoiceItemService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StoreRepositoryInterface::class, StoreRepository::class);
        $this->app->bind(StoreService::class, function ($app) {
            return new StoreService($app->make(StoreRepositoryInterface::class));
        });

        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(CategoryService::class, function ($app) {
            return new CategoryService($app->make(CategoryRepositoryInterface::class));
        });

        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(BrandService::class, function ($app) {
            return new BrandService($app->make(BrandRepositoryInterface::class));
        });

        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(ProductService::class, function ($app) {
            return new ProductService($app->make(ProductRepositoryInterface::class));
        });

        $this->app->bind(ProductVariantRepositoryInterface::class, ProductVariantRepository::class);
        $this->app->bind(ProductVariantService::class, function ($app) {
            return new ProductVariantService($app->make(ProductVariantRepositoryInterface::class));
        });

        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
        $this->app->bind(FeatureService::class, function ($app) {
            return new FeatureService($app->make(FeatureRepositoryInterface::class));
        });

        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(ContactService::class, function ($app) {
            return new ContactService($app->make(ContactRepositoryInterface::class));
        });

        $this->app->bind(ExternalInvoiceRepositoryInterface::class, ExternalInvoiceRepository::class);
        $this->app->bind(ExternalInvoiceService::class, function ($app) {
            return new ExternalInvoiceService($app->make(ExternalInvoiceRepositoryInterface::class));
        });

        $this->app->bind(TemporaryExternalInvoiceItemRepositoryInterface::class, TemporaryExternalInvoiceItemRepository::class);
        $this->app->bind(TemporaryExternalInvoiceItemService::class, function ($app) {
            return new TemporaryExternalInvoiceItemService($app->make(TemporaryExternalInvoiceItemRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
    }
}
