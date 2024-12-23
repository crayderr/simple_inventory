<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(
            \Deacero\Api\Product\Domain\ProductRepository::class,
            \Deacero\Api\Product\Infrastructure\ProductRepositoryEloquent::class,
        );
        $this->app->bind(
            \Deacero\Api\Inventory\Domain\InventoryRepository::class,
            \Deacero\Api\Inventory\Infrastructure\InventoryRepositoryEloquent::class,
        );
    }
}
