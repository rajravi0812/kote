<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user(); // Get the authenticated user
    
            // Check if user is logged in and fetch username and role_id
            $user_id = $user ? $user->id : null;
            $username = $user ? $user->username : null;
            $roleId = $user ? $user->role_id : null;
    
            // Share data with views
            $view->with([
                'user_id' => $user_id,
                'username' => $username,
                'role_id' => $roleId,
            ]);
        });
    }
    
}
