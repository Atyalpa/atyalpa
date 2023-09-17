<?php

use App\Http\Controllers\HomeController;

return FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/users', [HomeController::class, 'index']);
});
