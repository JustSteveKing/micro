<?php

declare(strict_types=1);

use DI\ContainerBuilder;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Container Builder.
$builder = new ContainerBuilder();

// Add Definitions.
$builder->addDefinitions(
    definitions: require __DIR__ . '/../config/container.php',
);

// Add Domain/User Definitions
$builder->addDefinitions(
    definitions: require __DIR__ . '/../config/domain-user.php',
);

// Build Container.
return $builder->build();
