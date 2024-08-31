<?php

use App\Http\Controllers\HomeController;
use Atyalpa\Routing\Router;

/** @var Router $router */
$router->get('/', [HomeController::class, 'index']);
