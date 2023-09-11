<?php

namespace Atyalpa;

class Router
{
    public function __construct(
        public readonly string $method,
        public readonly string $uri,
        public readonly mixed $handler,
    ) {
    }
}
