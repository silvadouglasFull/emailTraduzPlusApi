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
    $router->group(['prefix' => 'emails', 'middleware' => 'auth.apikey'], function () use ($router) {
        $router->get('/', 'EmailController@index');
        $router->get('/{id}', 'EmailController@show');
        $router->post('/send', 'EmailController@send');
        $router->put('/{id}', 'EmailController@update');
        $router->delete('/{id}', 'EmailController@destroy');
    });
});
