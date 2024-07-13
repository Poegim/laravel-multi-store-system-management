<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use App\Repositories\BrandRepository\BrandRepository;
use App\Repositories\BrandRepository\BrandRepositoryInterface;
use App\Services\StoreService;
use App\Services\CategoryService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Repositories\StoreRepository\StoreRepository;
use App\Repositories\CategoryRepository\CategoryRepository;
use App\Repositories\StoreRepository\StoreRepositoryInterface;
use App\Repositories\CategoryRepository\CategoryRepositoryInterface;
use App\Services\BrandService;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
    }
}
