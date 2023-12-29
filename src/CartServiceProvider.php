<?php

namespace Laraflow\Cart;

use Illuminate\Support\ServiceProvider;
use Laraflow\Cart\Commands\InstallCommand;
use Laraflow\Cart\Commands\CartCommand;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/cart.php', 'fintech.cart'
        );

        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
    }

    /**
     * Bootstrap any package services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/cart.php' => config_path('fintech/cart.php'),
        ]);

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'cart');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/cart'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'cart');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/cart'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                CartCommand::class,
            ]);
        }
    }
}
