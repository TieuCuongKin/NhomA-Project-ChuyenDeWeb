<?php

namespace Jobseeker\Application\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use JobSeeker\Domain\Admin\Repository\AdminRepository;
use JobSeeker\Port\Secondary\Database\Base\Admin\AdminRepositoryInterface;

class AdminServiceProvider extends ServiceProvider
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
