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
        // Share categories and collections globally to the store header
        \Illuminate\Support\Facades\View::composer('components.store-header', function ($view) {
            $view->with('categories', \App\Models\Category::all());
            $view->with('collections', \App\Models\Collection::all());
        });
    }
}
