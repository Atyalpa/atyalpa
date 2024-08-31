<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    #[Test]
    public function it_returns_passed_query_parameters_as_a_response(): void
    {
        $response = $this->get('?foo=bar');

        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame(
            ['data' => ['foo' => 'bar']],
            json_decode($response->getBody()->getContents(), true)
        );
    }
}
