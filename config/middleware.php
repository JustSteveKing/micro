<?php

declare(strict_types=1);

// Add our Application level Middleware
use JustSteveKing\Micro\Middleware\DisableFlocMiddleware;
use Slim\App;

return function (App $app) {
    // Google Floc Middleware
    $app->add(
        middleware: DisableFlocMiddleware::class,
    );

    // Routing Middleware
    $app->addRoutingMiddleware();

    // BodyParsingMiddleware
    $app->addBodyParsingMiddleware();

    // Error Middleware
    $app->addErrorMiddleware(
        displayErrorDetails: true,
        logErrors: true,
        logErrorDetails: true,
    );
};
