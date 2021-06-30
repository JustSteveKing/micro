<?php

declare(strict_types=1);

// Add our Application level Middleware
use JustSteveKing\Micro\Handlers\ProblemDetailHandler;
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
    $errorMiddleware = $app->addErrorMiddleware(
        displayErrorDetails: (bool) $_ENV['APP_DEBUG'],
        logErrors: true,
        logErrorDetails: true,
    );

    $errorMiddleware->setDefaultErrorHandler(
        handler: new ProblemDetailHandler(
            callableResolver: $app->getCallableResolver(),
            responseFactory: $app->getResponseFactory(),
        ),
    );
};
