<?php

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
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('user',  ['uses' => 'UserController@showAllUsers']);
    $router->get('user/{id}', ['uses' => 'UserController@showOneUser']);
    $router->put('user/{id}', ['uses' => 'UserController@update']);
    $router->post('user', ['uses' => 'UserController@create']);
    $router->delete('user/{id}', ['uses' => 'UserController@delete']);
    $router->get('source/{source}/destination/{destination}', ['uses' => 'TripController@search']);
    $router->post('triporganiser',['uses' => 'TripController@create']);
    $router->delete('triporganiser/{id}',['uses' => 'TripController@delete']);
    $router->put('triporganiser/{id}',['uses' => 'TripController@modify']);
    });
    