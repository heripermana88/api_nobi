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

$router->group(['prefix' => 'api/v1','middleware' => 'throttle'], function() use ($router){
    $router->group(['prefix' => 'auth'], function() use ($router){ 
        $router->post('/login','AuthController@login');
        $router->post('/register','AuthController@register');
    });
    
    $router->group(['middleware' => ['client.credentials','auth:api']], function() use ($router){
        $router->post('/auth/logout','AuthController@logout');
    
        $router->get('/users','UserController@index');
        $router->get('/users/trashed','UserController@trashed');
        $router->get('/users/{user_id}','UserController@getOne');
        $router->post('/users','UserController@store');
        $router->put('/users/{user_id}','UserController@update');
        $router->delete('/users/{user_id}','UserController@delete');

        $router->post('/transaction','TransactionController@withdraw');
    });
    $router->get('/quote','QuoteController@index');
});
