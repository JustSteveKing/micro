<?php

declare(strict_types=1);

use JustSteveKing\Micro\Contracts\KernelContract;
use JustSteveKing\Micro\Kernel;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return [
    KernelContract::class => function (ContainerInterface $container) {
        return Kernel::boot(
            basePath: __DIR__ . '/../',
            container: $container,
        );
    },

    LoggerInterface::class => function (ContainerInterface $container) {
        $logger = new Logger(
            name: 'micro',
        );

        $logger->pushProcessor(
            callback: new UidProcessor()
        );

        $logger->pushHandler(
            handler: new StreamHandler(
                stream: 'php://stderr',
                level: Logger::DEBUG,
            ),
        );

        return $logger;
    },
];
