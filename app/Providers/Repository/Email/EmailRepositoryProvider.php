<?php

namespace App\Providers\Repository\Email;


use App\Repositories\Email\EmailRepository;
use App\Repositories\Email\EmailRepositoryInterface;

use Illuminate\Support\ServiceProvider;


class EmailRepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EmailRepositoryInterface::class, function ($app) {
            return new EmailRepository();
        });
    }
}
