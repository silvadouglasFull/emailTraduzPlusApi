<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->group([
        'prefix' => 'emails',
        'middleware' => ['apikey', 'auth:api']
    ], function () use ($router) {
        $router->post('/send', 'Email\SendEmailController@send');
        $router->get('/', 'Email\EmailController@index');
        $router->get('/{id}', 'Email\EmailController@show');
        $router->post('', 'Email\EmailController@store');
        $router->put('/{id}', 'Email\EmailController@update');
        $router->delete('/{id}', 'Email\EmailController@destroy');
    });
    $router->post('login', 'Auth\AuthController@login');
    $router->post('logout', 'Auth\AuthController@logout');
    $router->post('token/refresh', 'Auth\AuthController@refresh');
    $router->group([
        'prefix' => 'pages',
        'middleware' => ['apikey', 'auth:api', 'checkrole:admin']
    ], function () use ($router) {
        $router->get('/', 'Page\PageController@index');
        $router->get('/{id}', 'Page\PageController@show');
        $router->post('', 'Page\PageController@store');
        $router->put('/{id}', 'Page\PageController@update');
        $router->delete('/{id}', 'Page\PageController@destroy');
    });
    $router->group([
        'prefix' => 'role-user',
        'middleware' => ['apikey', 'auth:api', 'checkrole:admin']
    ], function () use ($router) {
        $router->get('/', 'RoleUser\RoleUserController@index');
        $router->get('/{id}', 'RoleUser\RoleUserController@show');
        $router->post('', 'RoleUser\RoleUserController@store');
        $router->put('/{id}', 'RoleUser\RoleUserController@update');
        $router->delete('/{id}', 'RoleUser\RoleUserController@destroy');
    });
    $router->group([
        'prefix' => 'user',
        'middleware' => ['apikey', 'auth:api', 'checkrole:admin']
    ], function () use ($router) {
        $router->get('/', 'User\UserController@index');
        $router->get('/{id}', 'User\UserController@show');
        $router->post('', 'User\UserController@store');
        $router->put('/{id}', 'User\UserController@update');
        $router->delete('/{id}', 'User\UserController@destroy');
        $router->get('/me', 'User\UserController@me');
    });
});
