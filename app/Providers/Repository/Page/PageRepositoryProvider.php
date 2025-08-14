<?php

namespace App\Providers\Repository\Page;

use App\Repositories\Pages\PageRepository;
use App\Repositories\Pages\PageRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class PageRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PageRepositoryInterface::class, function ($app) {
            return new PageRepository();
        });
    }
}
