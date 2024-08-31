<?php

namespace App\Http\Middlewares;

use Atyalpa\Http\ResponseHandler;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ExampleRequestMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getQueryParams()) {
            return (new ResponseHandler())->json(['error' => 'Expected no query parameters.']);
        }

        return $handler->handle($request);
    }

}
