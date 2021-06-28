<?php

declare(strict_types=1);

// Our Container Builder Definitions
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Factory\AppFactory;

return [
    App::class => function (ContainerInterface $container) {
        AppFactory::setContainer(
            container: $container,
        );

        return AppFactory::create();
    },
];
