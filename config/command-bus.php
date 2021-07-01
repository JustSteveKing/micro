<?php

declare(strict_types=1);

use Domain\User\Contracts\UserServiceContract;
use Domain\User\Handlers\ListUsersHandler;
use Domain\User\Handlers\ShowUserHandler;
use Domain\User\Queries\ListUsersQuery;
use Domain\User\Queries\ShowUserQuery;
use League\Tactician\CommandBus;
use League\Tactician\Handler\CommandHandlerMiddleware;
use League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor;
use League\Tactician\Handler\Locator\InMemoryLocator;
use League\Tactician\Handler\MethodNameInflector\HandleInflector;
use Psr\Container\ContainerInterface;

return [
    CommandBus::class => function (ContainerInterface $container) {
        $locator = new InMemoryLocator();

        $locator->addHandler(
            new ListUsersHandler(
                service: $container->get(UserServiceContract::class),
            ),
            ListUsersQuery::class,
        );

        $locator->addHandler(
            new ShowUserHandler(
                service: $container->get(UserServiceContract::class),
            ),
            ShowUserQuery::class,
        );

        $handlerMiddleware = new CommandHandlerMiddleware(
            commandNameExtractor: new ClassNameExtractor(),
            handlerLocator: $locator,
            methodNameInflector: new HandleInflector(),
        );

        return new CommandBus(
            middleware: [$handlerMiddleware],
        );
    },
];
