<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
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
        \Illuminate\Pagination\Paginator::useBootstrapFive();

        View::composer('partials.header', function ($view) {
            $headerProducts = Product::with(['category', 'translations'])
                ->latest()
                ->take(4)
                ->get();

            $view->with('headerProducts', $headerProducts);
        });

        View::composer('partials.footer', function ($view) {
            $siteSettings = Setting::query()->pluck('value', 'key');

            $view->with('siteSettings', $siteSettings);
        });
    }
}
