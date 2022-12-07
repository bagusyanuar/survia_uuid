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

$router->group(['prefix' => 'api'], function () use ($router) {

    //v1
    $router->group(['prefix' => 'v1'], function () use ($router) {

        //admin
        $router->group(['prefix' => 'admin'], function () use ($router) {
            //authentication
            $router->group(['prefix' => 'auth'], function () use ($router) {
                $router->post('/sign-in', 'AuthController@admin_sign_in');
            });


            $router->group(['middleware' => ['auth']], function () use ($router) {
                $router->group(['prefix' => 'secs', 'namespace' => 'Admin'], function () use ($router) {
                    $router->get('/', 'SecController@index');
                    $router->post('/', 'SecController@index');

                });
            });
        });


        //member
        $router->group(['prefix' => 'member'], function () use ($router) {
//                $router->post('/login', 'AuthController@login');
        });
    });
});

