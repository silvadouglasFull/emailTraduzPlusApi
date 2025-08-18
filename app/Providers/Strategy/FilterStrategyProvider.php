<?php

namespace App\Providers\Strategy;

use App\Filters\DateFilterStrategy;
use App\Filters\FilterStrategyInterface;
use App\Filters\IntegerFilterStrategy;
use App\Filters\StringFilterStrategy;
use App\Services\Repository\FilterFieldMapperInterface;
use App\Services\Repository\Email\EmailFilterFieldMapper;
use App\Services\Repository\Page\PageFilterFieldMapper;
use App\Services\Repository\RoleUser\RoleUserFilterFieldMapper;
use App\Services\Repository\User\UserFilterFieldMapper;
use Illuminate\Support\ServiceProvider;


class FilterStrategyProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FilterStrategyInterface::class, function ($app) {
            return new IntegerFilterStrategy();
        });
        $this->app->bind(FilterStrategyInterface::class, function ($app) {
            return new StringFilterStrategy();
        });
        $this->app->bind(FilterStrategyInterface::class, function ($app) {
            return new DateFilterStrategy();
        });
        $this->app->bind(FilterFieldMapperInterface::class, function ($app) {
            return new PageFilterFieldMapper();
        });
        $this->app->bind(FilterFieldMapperInterface::class, function ($app) {
            return new EmailFilterFieldMapper();
        });
        $this->app->bind(FilterFieldMapperInterface::class, function ($app) {
            return new RoleUserFilterFieldMapper();
        });
        $this->app->bind(FilterFieldMapperInterface::class, function ($app) {
            return new UserFilterFieldMapper();
        });
    }
}
