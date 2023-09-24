<?php

use FastRoute\Dispatcher;
use DI\Container;

/** @var Container */
$container = require __DIR__ . '/../bootstrap/app.php';
/** @var Dispatcher */
$dispatcher = require __DIR__ . '/../web/routes.php';

$http = new React\Http\HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) use ($dispatcher, $container) {
    $app = new Atyalpa\Application($dispatcher, $container);

    return $app->handle($request);
});

$socket = new React\Socket\SocketServer('127.0.0.1:8080');
$http->listen($socket);

$http->on('error', function (Exception $e) use ($container) {
    $container->get('log')->error($e);

    echo 'Error ' . $e->getMessage() . PHP_EOL;
});

echo "Server running at http://127.0.0.1:8080" . PHP_EOL;
