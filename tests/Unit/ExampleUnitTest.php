<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class ExampleUnitTest extends TestCase
{
    #[Test]
    public function it_returns_true(): void
    {
        $this->assertTrue(true);
    }
}
