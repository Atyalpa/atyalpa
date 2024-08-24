<?php

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

return [
    'log' => function () {
        $log = new Logger('atyalpa');
        $log->pushHandler(new StreamHandler('storage/logs/atyalpa.log', Level::Warning));

        return $log;
    },
];
