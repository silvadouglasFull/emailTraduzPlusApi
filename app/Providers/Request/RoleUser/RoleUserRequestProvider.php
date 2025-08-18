<?php

namespace App\Providers\Request\RoleUser;

use App\Http\Requests\RoleUser\RoleUserStoreRequest;
use App\Http\Requests\RoleUser\RoleUserUpdateRequest;
use App\Http\Requests\RequestInterface;
use Illuminate\Support\ServiceProvider;

class RoleUserRequestProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RequestInterface::class, function () {
            return new RoleUserStoreRequest();
        });
        $this->app->bind(RequestInterface::class, function () {
            return new RoleUserUpdateRequest();
        });
    }
}
