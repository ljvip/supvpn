<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/website','WebsiteController');
    $router->resource('/ssr_m','SsrController');
    $router->resource("/user_cc","UserCcController");
    $router->resource("/user_url","UserUrlController");
    $router->resource("/user_ssr","UserSsrController");
    $router->resource("/platform","PlatformController");
});

