<?php

namespace App\Providers\Request\Pages;

use App\Http\Requests\Page\PageStoreRequest;
use App\Http\Requests\Page\PageUpdateRequest;
use App\Http\Requests\RequestInterface;
use Illuminate\Support\ServiceProvider;

class PagesRequestProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RequestInterface::class, function () {
            return new PageStoreRequest();
        });
        $this->app->bind(RequestInterface::class, function () {
            return new PageUpdateRequest();
        });
    }
}
