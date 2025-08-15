<?php

namespace App\Providers\Request\Email;

use App\Http\Requests\Email\EmailStoreRequest;
use App\Http\Requests\Email\EmailUpdateRequest;
use App\Http\Requests\RequestInterface;
use Illuminate\Support\ServiceProvider;

class EmailRequestProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(RequestInterface::class, function () {
            return new EmailStoreRequest();
        });
        $this->app->bind(RequestInterface::class, function () {
            return new EmailUpdateRequest();
        });
    }
}
