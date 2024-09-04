<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    #[Test]
    public function it_returns_error_if_query_parameters_are_passed(): void
    {
        $response = $this->get('?foo=bar');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(
            ['error' => 'Expected no query parameters.'],
            json_decode($response->getBody()->getContents(), true)
        );
    }

    #[Test]
    public function it_returns_response_if_no_query_parameters_are_passed(): void
    {
        $response = $this->get('/');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(
            ['data' => 'sample-data'],
            json_decode($response->getBody()->getContents(), true)
        );
    }
}
