<?php

namespace Atyalpa;

use Atyalpa\Services\Service;
use DI\Container;
use DI\DependencyException;
use DI\NotFoundException;
use React\Http\Message\Response;

use FastRoute\Dispatcher;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;

class Application implements RequestHandlerInterface
{
    public const VERSION = "0.1";
    protected string $basePath;

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function __construct(protected Container $container, ?string $basePath = null)
    {
        $this->basePath = rtrim($basePath, '\/');
        $this->loadEnvironment();
        $this->loadServices();
    }

    public function routePath(): string
    {
        return $this->basePath . '/web/routes.php';
    }

    public function servicePath(): string
    {
        return $this->basePath . '/app/Services.php';
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $router = $this->container->make(Router::class);

        $route = $router->group(fn (Router $router) => require_once $this->routePath())
            ->dispatch(
                $request->getMethod(),
                $request->getUri()->getPath()
            );

        switch ($route[0]) {
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $route[1];
                return Response::json([
                    'error' => 'Supported methods are ' . implode(', ', $allowedMethods)
                ])
                    ->withStatus(Response::STATUS_METHOD_NOT_ALLOWED);
            case Dispatcher::FOUND:
                $controller = $route[1];
                $parameters = $route[2];
                $message = $this->container->call($controller, $parameters);

                if (gettype($message) !== 'array') {
                    return Response::plaintext($message);
                }

                return Response::json($message);
            case Dispatcher::NOT_FOUND:
            default:
                return Response::json(['error' => 'Resource not found'])
                    ->withStatus(Response::STATUS_NOT_FOUND);
        }
    }

    /**
     * @throws DependencyException
     * @throws NotFoundException
     */
    protected function loadServices(): void
    {
        $services = require $this->servicePath();

        array_walk($services, function (string $service): void {
            if (is_subclass_of($service, Service::class) && method_exists($service, 'load')) {
                $this->container->make($service)->load();
            }
        });
    }

    protected function loadEnvironment(): void
    {
        $dotenv = \Dotenv\Dotenv::createImmutable($this->basePath);
        $dotenv->load();
    }
}
