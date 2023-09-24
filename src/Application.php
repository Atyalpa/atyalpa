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

    public function __construct(protected Dispatcher $dispatcher, protected Container $container)
    {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $router = $this->dispatcher->dispatch($request->getMethod(), $request->getUri()->getPath());

        switch ($router[0]) {
            case Dispatcher::NOT_FOUND:
                return Response::json(['error' => 'Resource not found'])
                    ->withStatus(Response::STATUS_NOT_FOUND);

                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $router[1];
                return Response::json([
                    'error' => 'Supported methods are ' . implode(', ', $allowedMethods)
                ])
                    ->withStatus(Response::STATUS_METHOD_NOT_ALLOWED);

                break;
            case Dispatcher::FOUND:
                $controller = $router[1];
                $parameters = $router[2];
                $message = $this->container->call($controller, $parameters);

                if (gettype($message) !== 'array') {
                    return Response::plaintext($message);
                }

                return Response::json($message);

                break;
        }
    }
}
