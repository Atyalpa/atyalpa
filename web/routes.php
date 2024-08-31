<?php

use App\Http\Controllers\HomeController;
use App\Http\Middlewares\ExampleRequestMiddleware;
use App\Http\Middlewares\ExampleResponseMiddleware;
use Atyalpa\Routing\Router;

/** @var Router $router */
$router->middleware([
    ExampleRequestMiddleware::class,
    ExampleResponseMiddleware::class,
])
->get('/', [HomeController::class, 'index']);
