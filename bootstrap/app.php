<?php

require __DIR__ . '../../vendor/autoload.php';

use DI\ContainerBuilder;

$container_builder = new ContainerBuilder();

$container_builder->enableCompilation(__DIR__ . '/cache');
$container_builder->addDefinitions(__DIR__ . '/../app/Container.php');

$container = $container_builder->build();

return $container;
