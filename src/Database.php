<?php

namespace Atyalpa;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database
{
    public function __construct(Capsule $capsule)
    {
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'atyalpa',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
