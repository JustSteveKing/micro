<?php

declare(strict_types=1);

use App\Handlers\RootHandler;
use App\Handlers\TestHandler;
use App\Handlers\UsersShowHandler;
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

    /**
     * Test Route
     */
    $app->get(
        pattern: '/test',
        callable: TestHandler::class,
    )->setName(
        name: 'api:test'
    );

    $app->get(
        pattern: '/users/{id}',
        callable: UsersShowHandler::class,
    )->setName(
        name: 'api:users:show'
    );
};