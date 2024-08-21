<?php

require __DIR__ . '../../vendor/autoload.php';

use DI\ContainerBuilder;
use Atyalpa\Core\Application;

$containerBuilder = new ContainerBuilder();

$containerBuilder->enableCompilation(__DIR__ . '/cache');
$containerBuilder->addDefinitions(__DIR__ . '/../app/Container.php');

$container = $containerBuilder->build();

$app = new Application($container, dirname(__DIR__));

return $app;
