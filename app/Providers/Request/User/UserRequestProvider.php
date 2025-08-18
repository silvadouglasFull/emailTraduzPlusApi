<?php

namespace App\Providers\Request\User;

use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\RequestInterface;
use Illuminate\Support\ServiceProvider;

class UserRequestProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RequestInterface::class, function () {
            return new UserStoreRequest();
        });
        $this->app->bind(RequestInterface::class, function () {
            return new UserUpdateRequest();
        });
    }
}
