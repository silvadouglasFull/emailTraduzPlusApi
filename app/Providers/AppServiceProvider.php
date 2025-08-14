<?php

namespace App\Providers;

use App\Filters\DateFilterStrategy;
use App\Filters\FilterStrategyInterface;
use App\Filters\IntegerFilterStrategy;
use App\Filters\StringFilterStrategy;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserRequestInterface;
use App\Repositories\PageRepository;
use App\Repositories\PageRepositoryInterface;
use App\Repositories\RoleUserInterface;
use App\Repositories\RoleUserRepository;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use App\Services\CheckRole\CheckRoleAdminService;
use App\Services\CheckRole\CheckRoleInterface;
use App\Services\CheckRole\CheckRoleManagerService;
use App\Services\Repository\FilterFieldMapperInterface;
use App\Services\Repository\Page\PagesFilterFieldMapper;
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
        $this->app->bind(RoleUserInterface::class, function ($app) {
            return new RoleUserRepository();
        });
        $this->app->bind(CheckRoleInterface::class, function ($app) {
            return new CheckRoleAdminService();
        });
        $this->app->bind(CheckRoleInterface::class, function ($app) {
            return new CheckRoleManagerService();
        });
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
            return new PagesFilterFieldMapper();
        });
    }
}
