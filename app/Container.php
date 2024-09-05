<?php

use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;

return [
    'log' => function () {
        $log = new Logger('atyalpa');
        $log_postfix = date('Y_m_d');
        $log->pushHandler(new StreamHandler("storage/logs/atyalpa_$log_postfix.log", Level::Warning));

        return $log;
    },
];
