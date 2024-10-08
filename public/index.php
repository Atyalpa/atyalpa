<?php

use Atyalpa\Core\Application;
use DI\Container;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Socket\SocketServer;

/** @var Container $container */
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$http = new HttpServer(function (ServerRequestInterface $request) use ($app) {
    return $app->handle($request);
});

$socket = new SocketServer($_ENV['APP_URL'].':'.$_ENV['APP_PORT']);
$http->listen($socket);

$http->on('error', function (Exception $e) use ($container) {
    $container->get('log')->error($e);

    echo 'Error '.$e->getMessage().PHP_EOL;
});

echo 'Server running at http://127.0.0.1:8080'.PHP_EOL;
