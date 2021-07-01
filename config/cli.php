<?php

declare(strict_types=1);

use App\Console\RouteListCommand;
use JustSteveKing\Config\Repository;
use JustSteveKing\Micro\Contracts\KernelContract;
use Psr\Container\ContainerInterface;
use Symfony\Component\Console\Application;

return [
    Application::class => function (ContainerInterface $container) {
        $application = new Application(
            name: 'micro cli',
        );

        /**
         * @var Repository $config
         */
        $config = $container->get(Repository::class);

        foreach ($config->get('app.console.commands') as $class) {
            $application->add(
                command: $container->get($class),
            );
        }

        return $application;
    },

    RouteListCommand::class => function (ContainerInterface $container) {
        return new RouteListCommand(
            slim: $container->get(KernelContract::class)->app(),
        );
    }
];
