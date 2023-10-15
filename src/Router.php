<?php

declare(strict_types=1);

namespace Atyalpa;

use Closure;

class Router
{
    protected array $routes = [];
    protected string $prefix = '';

    public function __call($name, $arguments): self
    {
        return $this->addRoute(strtoupper($name), ...$arguments);
    }

    public function addRoute(string $method, string $uri, array|Closure $action): self
    {
        $this->routes[$this->prefix . '/' . ltrim($uri, '/')] = [
            'method' => $method,
            'uri' => $this->prefix . '/' . ltrim($uri, '/'),
            'action' => $action
        ];

        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = trim($prefix, '/');

        return $this;
    }

    public function group(Closure $closure): self
    {
        $closure($this);
        $this->prefix = '';

        return $this;
    }

    public function dispatch(string $method, string $path): array
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $r) {
            foreach ($this->routes as $route) {
                $r->addRoute($route['method'], $route['uri'], $route['action']);
            }
        });

        return $dispatcher->dispatch($method, $path);
    }
}
