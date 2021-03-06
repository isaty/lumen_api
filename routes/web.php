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
    $router->put('login', ['uses' => 'UserController@login']);
     $router->put('logout', ['uses' => 'UserController@logout']);
    
    $router->get('source/{source}/destination/{destination}', ['uses' => 'TripController@search']);
    $router->post('triporganiser',['uses' => 'TripController@create']);
    $router->delete('triporganiser/{id}',['uses' => 'TripController@delete']);
    $router->put('triporganiser/{id}',['uses' => 'TripController@modify']);

    $router->get('tripparticipation/{id}', ['uses' => 'TripparticipationController@search']);
    $router->post('tripparticipation', ['uses' => 'TripparticipationController@create']);
    $router->delete('tripparticipation/{id}', ['uses' => 'TripparticipationController@delete']);

    $router->delete('schedule/{id}', ['uses' => 'ScheduleController@delete']);
    $router->post('schedule', ['uses' => 'ScheduleController@create']);
    $router->put('schedule/{id}', ['uses' => 'ScheduleController@modify']);
    
    $router->delete('checkpoint/{id}', ['uses' => 'CheckpointsController@delete']);
    $router->post('checkpoint', ['uses' => 'CheckpointsController@create']);
    $router->put('checkpoint/{id}', ['uses' => 'CheckpointsController@modify']);
    });
    