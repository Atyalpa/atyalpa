<?php

declare(strict_types=1);

namespace Atyalpa\Http;

use React\Http\Message\Response as BaseResponse;

class Response extends BaseResponse
{
    public function __construct(
        public readonly string|array $content = [],
        public readonly int $status = 200,
        public readonly array $headers = []
    ) {
    }

    public function render(): self
    {
        if ($this->headers) {
            self::setHeaders($this->headers);
        }

        if (is_array($this->content)) {
            return self::json($this->content)->withStatus($this->status);
        }

        if (is_string($this->content)) {
            return self::plaintext($this->content)->withStatus($this->status);
        }
    }
}
