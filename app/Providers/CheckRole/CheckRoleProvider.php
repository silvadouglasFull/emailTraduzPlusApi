<?php

namespace App\Providers\CheckRole;

use App\Services\CheckRole\CheckRoleAdminService;
use App\Services\CheckRole\CheckRoleInterface;
use App\Services\CheckRole\CheckRoleManagerService;

use Illuminate\Support\ServiceProvider;


class CheckRoleProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(CheckRoleInterface::class, function ($app) {
            return new CheckRoleAdminService();
        });
        $this->app->bind(CheckRoleInterface::class, function ($app) {
            return new CheckRoleManagerService();
        });
    }
}
