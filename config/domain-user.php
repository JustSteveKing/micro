<?php

declare(strict_types=1);

use Doctrine\DBAL\Connection;
use Domain\User\Contracts\UserRepositoryContract;
use Domain\User\Contracts\UserServiceContract;
use Infrastructure\Database\DoctrineUserRepositoryContract;
use Infrastructure\Database\DoctrineUserServiceContract;
use Psr\Container\ContainerInterface;

return [
    UserServiceContract::class => function (ContainerInterface $container) {
        return new DoctrineUserServiceContract(
            repository: $container->get(UserRepositoryContract::class),
        );
    },

    UserRepositoryContract::class => function (ContainerInterface $container) {
        return new DoctrineUserRepositoryContract(
            connection: $container->get(Connection::class),
        );
    },
];
