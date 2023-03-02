<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use React\Http\HttpServer;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;

$routes = new RouteCollection;
$routes->add('home', new Route('/home', [
	'_controller' => [new HomeController, 'index']
]));

$context = new RequestContext();
$context->fromRequest(Request::createFromGlobals());

$matcher = new UrlMatcher($routes, $context);

$server = new HttpServer(function (Psr\Http\Message\ServerRequestInterface $request) use ($matcher) {
	$parameters = $matcher->match($request->getUri()->getPath());
	$controller = $parameters['_controller'];
	unset($parameters['_controller']);
	$response = $controller($request, ...array_values($parameters));

	return \React\Http\Message\Response::plaintext($response);
});

$socket = new React\Socket\SocketServer('127.0.0.1:8080');
$server->listen($socket);

$server->on('error', function (Exception $e) {
	var_dump($e->getMessage());
	var_dump(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 10));
});

echo "Server running at http://127.0.0.1:8080" . PHP_EOL;
