<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use JobSeeker\Domain\JobSeekerManagement\User\Interfaces\UserRepositoryInterface;
use JobSeeker\Domain\MasterManagement\Admin\Interfaces\AdminRepositoryInterface;
use JobSeeker\Port\Secondary\Database\Admin\AdminRepository;
use JobSeeker\Port\Secondary\Database\User\UserRepository;

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
