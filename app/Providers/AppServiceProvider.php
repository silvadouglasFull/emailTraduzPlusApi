<?php

namespace App\Providers;

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
    }
}
