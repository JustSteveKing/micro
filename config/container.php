<?php

declare(strict_types=1);

// Our Container Builder Definitions
use JustSteveKing\Micro\Contracts\KernelContract;
use JustSteveKing\Micro\Kernel;
use Psr\Container\ContainerInterface;

return [
    KernelContract::class => function (ContainerInterface $container) {
        return Kernel::boot(
            basePath: __DIR__ . '/../',
            container: $container,
        );
    },
];
