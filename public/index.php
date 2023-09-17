<?php

use Atyalpa\Route;
use DI\Container;

require __DIR__ . '/../vendor/autoload.php';

/** @var Container */
$container = require __DIR__ . '/../bootstrap/app.php';
$dispatcher = require __DIR__ . '/../web/routes.php';

$http = new React\Http\HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) use ($dispatcher, $container) {
    try {
        $router = $dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());

        switch ($router[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                return React\Http\Message\Response::plaintext('The URL not found!', React\Http\Message\Response::STATUS_NOT_FOUND);
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $router[1];
                return React\Http\Message\Response::plaintext('', React\Http\Message\Response::STATUS_METHOD_NOT_ALLOWED);
                break;
            case FastRoute\Dispatcher::FOUND:
                $controller = $router[1];
                $parameters = $router[2];
                $message = $container->call($controller, $parameters);

                return React\Http\Message\Response::plaintext($message);
                break;
        }
    } catch (\Exception $e) {
        return React\Http\Message\Response::plaintext($e->getMessage(), React\Http\Message\Response::STATUS_INTERNAL_SERVER_ERROR);
    }
});

$socket = new React\Socket\SocketServer('127.0.0.1:8080');
$http->listen($socket);

$http->on('error', function (Exception $e) use ($container) {
    $container->get('log')->error($e);

    echo 'Error ' . $e->getMessage() . PHP_EOL;
});

echo "Server running at http://127.0.0.1:8080" . PHP_EOL;
