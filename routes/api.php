<?php

declare(strict_types=1);

use App\Handlers\RootHandler;
use Slim\App;

/**
 * Our application routes.
 */
return function (App $app) {

    /**
     * Root Handler
     */
    $app->get(
        pattern: '/',
        callable: RootHandler::class,
    )->setName(
        name: 'api:root',
    );
};