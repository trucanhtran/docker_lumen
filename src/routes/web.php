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

$router->group(['prefix' => 'api'], function () use ($router){
    $router->get(uri:'/users', action:'UsersController@index');
    $router->post(uri:'/users', action:'UsersController@store');
    $router->put(uri:'/users/{id}', action:'UsersController@update');
    $router->delete(uri:'/users/{id}', action:'UsersController@destroy');
});

$router->get(uri:'/test', action:'TestController@index');
$router->post(uri:'/login', action:'TestController@login');