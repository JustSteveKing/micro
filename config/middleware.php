<?php

declare(strict_types=1);

// Add our Application level Middleware
use JustSteveKing\Micro\Handlers\ProblemDetailHandler;
use JustSteveKing\Micro\Middleware\DisableFlocMiddleware;
use Slim\App;

return function (App $app) {
    // Error Middleware
    $errorMiddleware = $app->addErrorMiddleware(
        displayErrorDetails: (bool) $_ENV['APP_DEBUG'],
        logErrors: true,
        logErrorDetails: true,
    );

    // Google Floc Middleware
    $app->add(
        middleware: DisableFlocMiddleware::class,
    );

    // BodyParsingMiddleware
    $app->addBodyParsingMiddleware();

    // Routing Middleware
    $app->addRoutingMiddleware();

    $errorMiddleware->setDefaultErrorHandler(
        handler: new ProblemDetailHandler(
            callableResolver: $app->getCallableResolver(),
            responseFactory: $app->getResponseFactory(),
        ),
    );
};
