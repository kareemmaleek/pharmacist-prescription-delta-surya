<?php

namespace App\Providers;

use Illuminate\Support\Number;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
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
        Model::automaticallyEagerLoadRelationships();
        Number::useLocale('id');
        Number::useCurrency('IDR');
        // Blade::directive('currency', function ($expression) {
        //     return Number::currency($expression);
        // });
    }
}
