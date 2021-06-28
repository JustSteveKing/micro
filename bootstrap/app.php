<?php

declare(strict_types=1);

// Create our Slim Application and return it.
use DI\ContainerBuilder;
use Slim\App;

require_once __DIR__ . '/../vendor/autoload.php';

// Container Builder.
$builder = new ContainerBuilder();

// Add Definitions.
$builder->addDefinitions(
    definitions: __DIR__ . '/../config/container.php',
);

// Build Container.
$container = $builder->build();

// Create our Application Instance.
$app = $container->get(App::class);

// Register Routes.
(require __DIR__ . '/../routes/api.php')($app);

// Register Middleware.
(require __DIR__ . '/../config/middleware.php')($app);

// Return App.
return $app;
