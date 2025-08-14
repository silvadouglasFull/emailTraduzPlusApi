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
    $router->group(['prefix' => 'emails', 'middleware' => 'apikey'], function () use ($router) {
        $router->get('/', 'EmailController@index');
        $router->get('/{id}', 'EmailController@show');
        $router->post('/send', 'EmailController@send');
        $router->put('/{id}', 'EmailController@update');
        $router->delete('/{id}', 'EmailController@destroy');
    });
    $router->post('login', 'Auth\AuthController@login');
    $router->post('logout', 'Auth\AuthController@logout');
    $router->post('token/refresh', 'Auth\AuthController@refresh');
    $router->group(['prefix' => 'users', 'middleware' => 'auth:api'], function () use ($router) {
        $router->get('', 'UserController@getUsers');
        $router->get('me', 'UserController@me');
        $router->post('register', 'UserController@register');
    });
    $router->group([
        'prefix' => 'pages',
        'middleware' => ['apikey', 'auth:api', 'checkrole:admin']
    ], function () use ($router) {
        $router->get('/', 'PageController@index');
        $router->get('/{id}', 'PageController@show');
        $router->post('', 'PageController@send');
        $router->put('/{id}', 'PageController@update');
        $router->delete('/{id}', 'PageController@destroy');
    });
});
