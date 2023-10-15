<?php

use App\Http\Controllers\HomeController;

$router->get('/users', [HomeController::class, 'index']);
