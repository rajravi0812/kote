<?php

namespace App\Providers;

use App\Models\Title;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
    // public function boot(): void
    // {
    //     View::composer('admin.dashboard.common.header', function ($view) {
    //         $title = Title::get(); // Example query
    //         $view->with('headerTitle', $title);
    //     });
    //     Paginator::useBootstrap();
    // }

    public function boot(): void
{
    // Fetch title once and share it globally
    $title = Title::get(); // Example query
    View::share('headerTitle', $title);

    // Ensure Bootstrap pagination
    Paginator::useBootstrap();
}
}
