<?php

namespace Atyalpa;

use FastRoute\Dispatcher;

class Route
{
    /** @var Router[] */
    protected array $routes = [];

    public function dispatch(): Dispatcher
    {
        return \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute($route->method, $route->uri, $route->handler);
            }
        });
    }

    public function get(string $uri, $handler): void
    {
        $routes[] = new Router('GET', $uri, $handler);
    }

    public function post(string $uri, $handler): void
    {
        $routes[] = new Router('POST', $uri, $handler);
    }

    public function put(string $uri, $handler): void
    {
        $routes[] = new Router('PUT', $uri, $handler);
    }

    public function patch(string $uri, $handler): void
    {
        $routes[] = new Router('PATCH', $uri, $handler);
    }

    public function delete(string $uri, $handler): void
    {
        $routes[] = new Router('DELETE', $uri, $handler);
    }

    public function options(string $uri, $handler): void
    {
        $routes[] = new Router('OPTIONS', $uri, $handler);
    }
}
