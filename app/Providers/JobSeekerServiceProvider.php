<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JobSeeker\Domain\Admin\Repository\AdminRepository;
use JobSeeker\Domain\User\Repository\UserRepository;
use JobSeeker\Port\Secondary\Database\Admin\AdminRepositoryInterface;
use JobSeeker\Port\Secondary\Database\User\UserRepositoryInterface;

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
