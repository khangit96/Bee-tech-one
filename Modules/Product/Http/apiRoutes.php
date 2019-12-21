<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['middleware' => 'api.token'], function (Router $router) {
    $router->get('products', [
        'as' => 'api.product.all',
        'uses' => 'ProductController@all'
    ]);
});
