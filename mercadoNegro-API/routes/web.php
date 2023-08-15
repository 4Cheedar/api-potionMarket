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

$router->group(['middleware' => 'apicheck'], function() use ($router){

    // Rota Poções
    $router->get('/pocoes', ['uses' => 'PocoesController@index', 'as' => 'pocoes.all']);
    $router->get('/pocoes/{id}', ['uses' => 'PocoesController@show', 'as' => 'pocoes.one']);
    $router->post('/pocoes', ['uses' => 'PocoesController@store', 'as' => 'pocoes.store']);
    $router->delete('/pocoes/{id}', ['uses' => 'PocoesController@destroy', 'as' => 'pocoes.delete']);
    $router->put('/pocoes/{id}', ['uses' => 'PocoesController@update', 'as' => 'pocoes.update']);

    // Rota Inventario
    $router->get('/inventario', ['uses' => 'InventarioController@index', 'as' => 'inventario.all']);
    $router->get('/inventario/{id}', ['uses' => 'InventarioController@show', 'as' => 'inventario.one']);
    $router->post('/inventario', ['uses' => 'InventarioController@store', 'as' => 'inventario.store']);
    $router->delete('/inventario/{id}', ['uses' => 'InventarioController@destroy', 'as' => 'inventario.delete']);
    $router->put('/inventario/{id}', ['uses' => 'InventarioController@update', 'as' => 'inventario.update']);

});

$router->post('/autenticar', ['uses' => 'UsuarioAPIController@store']);











