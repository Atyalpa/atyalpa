<?php

use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

return [
    'log' => function () {
        $log = new Logger('atyalpa');
        $log->pushHandler(new StreamHandler('storage/logs/atyalpa.log', Level::Warning));

        return $log;
    },
];
