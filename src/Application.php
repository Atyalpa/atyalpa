<?php

namespace Atyalpa;

use DI\Container;
use React\Http\Message\Response;

use FastRoute\Dispatcher;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Application implements RequestHandlerInterface
{
    public const VERSION = "0.1";

    public function __construct(protected Container $container)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $router = $this->container->make(Router::class);

        $route = $router->group(fn (Router $router) => require __DIR__ . '/../web/routes.php')
            ->dispatch(
                $request->getMethod(),
                $request->getUri()->getPath()
            );

        switch ($route[0]) {
            case Dispatcher::NOT_FOUND:
                return Response::json(['error' => 'Resource not found'])
                    ->withStatus(Response::STATUS_NOT_FOUND);

                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $route[1];
                return Response::json([
                    'error' => 'Supported methods are ' . implode(', ', $allowedMethods)
                ])
                    ->withStatus(Response::STATUS_METHOD_NOT_ALLOWED);

                break;
            case Dispatcher::FOUND:
                $controller = $route[1];
                $parameters = $route[2];
                $message = $this->container->call($controller, $parameters);

                if (gettype($message) !== 'array') {
                    return Response::plaintext($message);
                }

                return Response::json($message);

                break;
        }
    }
}
