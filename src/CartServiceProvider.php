<?php

namespace Laraflow\Cart;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/cart.php', 'cart'
        );

        $this->app->singleton('cart', fn($app) => new Cart());

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/cart.php' => config_path('fintech/cart.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cart');

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/cart'),
        ]);

//        if ($this->app->runningInConsole()) {
//            $this->commands([
//                InstallCommand::class,
//                CartCommand::class,
//            ]);
//        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['cart', Cart::class];
    }
}
