<?php

namespace Tests;

use Atyalpa\Core\Application;
use Psr\Http\Message\ResponseInterface;
use React\Http\Message\ServerRequest;

/**
 * @property Application $app
 * @property string $baseUrl
 */
trait UsingHttpClient
{
    protected function get(string $url, array $parameters = [], array $headers = []): ResponseInterface
    {
        $url = trim($url, '/').http_build_query($parameters);

        return $this->proces('GET', $url, $headers);
    }

    protected function post(string $url, array $payload = [], array $headers = []): ResponseInterface
    {
        return $this->proces('POST', $url, $headers, $payload);
    }

    protected function put(string $url, array $payload = [], array $headers = []): ResponseInterface
    {
        return $this->proces('PUT', $url, $headers, $payload);
    }

    protected function patch(string $url, array $payload = [], array $headers = []): ResponseInterface
    {
        return $this->proces('PATCH', $url, $headers, $payload);
    }

    protected function delete(string $url, array $payload = [], array $headers = []): ResponseInterface
    {
        return $this->proces('DELETE', $url, $headers, $payload);
    }

    protected function proces(string $method, string $url, array $headers = [], array $body = []): ResponseInterface
    {
        $url = trim($this->baseUrl, '/').'/'.trim($url, '/');

        $request = new ServerRequest($method, $url, $headers, json_encode($body));

        return $this->app->handle($request);
    }
}
