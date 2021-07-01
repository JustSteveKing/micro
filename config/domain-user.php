<?php

declare(strict_types=1);

use Doctrine\DBAL\Connection;
use Domain\User\UserRepository;
use Domain\User\UserService;
use Infrastructure\Database\DoctrineUserRepository;
use Infrastructure\Database\DoctrineUserService;
use Psr\Container\ContainerInterface;

return [
    UserService::class => function (ContainerInterface $container) {
        return new DoctrineUserService(
            repository: $container->get(UserRepository::class),
        );
    },

    UserRepository::class => function (ContainerInterface $container) {
        return new DoctrineUserRepository(
            connection: $container->get(Connection::class),
        );
    },
];
