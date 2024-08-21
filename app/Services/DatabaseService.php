<?php

namespace App\Services;

use Atyalpa\Core\Services\Service;
use Illuminate\Database\Capsule\Manager as Capsule;

class DatabaseService extends Service
{
    public function __construct(protected Capsule $capsule)
    {
    }

    public function load(): void
    {
        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'atyalpa',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}
