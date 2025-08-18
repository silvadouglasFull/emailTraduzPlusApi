<?php

namespace App\Providers\Repository\RoleUser;

use App\Repositories\RoleUser\RoleUserRepository;
use App\Repositories\RoleUser\RoleUserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RoleUserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RoleUserRepositoryInterface::class, function ($app) {
            return new RoleUserRepository();
        });
    }
}
