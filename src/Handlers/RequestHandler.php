<?php

declare(strict_types=1);

namespace Atyalpa\Handlers;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;

class RequestHandler implements ServerRequestInterface
{
    public function __construct(private ServerRequestInterface $request)
    {
    }

    public function getProtocolVersion(): string
    {
        return $this->request->getProtocolVersion();
    }

    public function withProtocolVersion(string $version): static
    {
        $this->request = $this->request->withProtocolVersion($version);

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->request->getHeaders();
    }

    public function hasHeader(string $name): bool
    {
        return $this->request->hasHeader($name);
    }

    public function getHeader(string $name): array
    {
        return $this->request->getHeader($name);
    }

    public function getHeaderLine(string $name): string
    {
        return $this->request->getHeaderLine($name);
    }

    public function withHeader(string $name, $value): static
    {
        $this->request = $this->request->withHeader($name, $value);

        return $this;
    }

    public function withAddedHeader(string $name, $value): static
    {
        $this->request = $this->request->withAddedHeader($name, $value);

        return $this;
    }

    public function withoutHeader(string $name): static
    {
        $this->request = $this->request->withoutHeader($name);

        return $this;
    }

    public function getBody(): StreamInterface
    {
        return $this->request->getBody();
    }

    public function withBody(StreamInterface $body): static
    {
        $this->request = $this->request->withBody($body);

        return $this;
    }

    public function getRequestTarget(): string
    {
        return $this->request->getRequestTarget();
    }

    public function withRequestTarget(string $requestTarget): static
    {
        $this->request = $this->request->withRequestTarget($requestTarget);

        return $this;
    }

    public function getMethod(): string
    {
        return $this->request->getMethod();
    }

    public function withMethod(string $method): static
    {
        $this->request = $this->request->withMethod($method);

        return $this;
    }

    public function getUri(): UriInterface
    {
        return $this->request->getUri();
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): static
    {
        $this->request = $this->request->withUri($uri, $preserveHost);

        return $this;
    }

    public function getServerParams(): array
    {
        return $this->request->getServerParams();
    }

    public function getCookieParams(): array
    {
        return $this->request->getCookieParams();
    }

    public function withCookieParams(array $cookies): static
    {
        $this->request = $this->request->withCookieParams($cookies);

        return $this;
    }

    public function getQueryParams(): array
    {
        return $this->request->getQueryParams();
    }

    public function withQueryParams(array $query): static
    {
        $this->request = $this->request->withQueryParams($query);

        return $this;
    }

    public function getUploadedFiles(): array
    {
        return $this->request->getUploadedFiles();
    }

    public function withUploadedFiles(array $uploadedFiles): static
    {
        $this->request = $this->request->withUploadedFiles($uploadedFiles);

        return $this;
    }

    public function getParsedBody(): array
    {
        return $this->request->getParsedBody();
    }

    public function withParsedBody($data): static
    {
        $this->request = $this->request->withParsedBody($data);

        return $this;
    }

    public function getAttributes(): array
    {
        return $this->request->getAttributes();
    }

    public function getAttribute(string $name, $default = null): mixed
    {
        return $this->request->getAttribute($name, $default);
    }

    public function withAttribute(string $name, $value): static
    {
        $this->request = $this->request->withAttribute($name, $value);

        return $this;
    }

    public function withoutAttribute(string $name): static
    {
        $this->request = $this->request->withoutAttribute($name);

        return $this;
    }
}
