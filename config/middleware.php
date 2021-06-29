<?php

declare(strict_types=1);

// Add our Application level Middleware
use Slim\App;

return function (App $app) {
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
