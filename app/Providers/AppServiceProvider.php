<?php

namespace App\Providers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestInterface;
use App\Repositories\PageRepository;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Utils\ArrayFilter\ArrayFilterInterface;
use App\Utils\ArrayFilter\ArrayFilter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ArrayFilterInterface::class, function ($app) {
            return new ArrayFilter();
        });
        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository();
        });
        $this->app->bind(UserRequestInterface::class, function ($app) {
            return new UserRequest();
        });
        $this->app->bind(PageRepositoryInterface::class, function ($app) {
            return new PageRepository();
        });
    }
}
