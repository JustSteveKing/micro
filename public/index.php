<?php

declare(strict_types=1);

use JustSteveKing\Micro\Contracts\KernelContract;
use Slim\Handlers\Strategies\RequestHandler;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Build our Container.
 *
 * @var \DI\Container
 */
$container = require __DIR__ . '/../bootstrap/app.php';

/**
 * Create our Application Instance.
 *
 * @var \JustSteveKing\Micro\Kernel
 */
$kernel = $container->get(
    name: KernelContract::class,
);

/**
 * Register our API routes.
 */
(require __DIR__ . '/../routes/api.php')($kernel->app());

/**
 * Register our Application Middleware.
 */
(require __DIR__ . '/../config/middleware.php')($kernel->app());

/**
 * Assign matched route arguments to Request attributes for PSR-15 handlers
 */
$kernel->app()->getRouteCollector()->setDefaultInvocationStrategy(
    strategy: new RequestHandler(
        appendRouteArgumentsToRequestAttributes: true,
    ),
);

/**
 * Start our Application.
 */
$kernel->start();
//dd($kernel);