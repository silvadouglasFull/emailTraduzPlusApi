<?php

namespace App\Providers\Repository\User;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository();
        });
        $this->app->bind(UserRequestInterface::class, function ($app) {
            return new UserRequest();
        });
    }
}
