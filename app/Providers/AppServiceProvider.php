<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        Schema::defaultStringLength(191);
        Gate::define('view-page-admin', function ($user) {
            if ($user->admin == "1") {
                return true;
            }
            return false;
        });
        Gate::define('view-page-guest', function ($user) {
            if ($user->admin == "1" || $user->admin == "0") {
                return true;
            }
            return false;
        });
    }
}
