<?php

namespace Tests;

use Atyalpa\Core\Application;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use UsingHttpClient;

    protected Application $app;

    protected string $baseUrl = '';

    protected function setUp(): void
    {
        $this->app = require __DIR__.'/../bootstrap/app.php';
        $this->baseUrl = $_ENV['APP_URL'].':'.$_ENV['APP_PORT'];
    }
}
