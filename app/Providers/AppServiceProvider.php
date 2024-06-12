<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use App\Repositories\StoreRepository\StoreRepository;
use App\Repositories\StoreRepository\StoreRepositoryInterface;
use App\Services\StoreService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;


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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(User::class, UserPolicy::class);
    }
}
