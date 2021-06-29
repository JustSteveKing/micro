<?php

declare(strict_types=1);

use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

// Container Builder.
$builder = new ContainerBuilder();

// Add Definitions.
$builder->addDefinitions(
    definitions: require __DIR__ . '/../config/container.php',
);

// Build Container.
return $builder->build();
