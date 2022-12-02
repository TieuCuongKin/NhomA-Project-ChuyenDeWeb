<?php

namespace App\Providers;

use App\Repositories\Admin\AdminRepository;
use App\Repositories\AdminRepositoryInterface;
use App\Repositories\Location\LocationRepository;
use App\Repositories\LocationRepositoryInterface;
use App\Repositories\User\UserDetailRepository;
use App\Repositories\User\UserRepository;
use App\Repositories\UserDetailRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;


class JobSeekerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserDetailRepositoryInterface::class, UserDetailRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
