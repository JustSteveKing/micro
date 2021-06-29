<?php

declare(strict_types=1);

namespace App\Console;

use Slim\App;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RouteListCommand extends Command
{
    protected static $defaultName = 'route:list';

    protected static $defaultDescription = 'List all registered routes.';

    public function __construct(
        private App $slim,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = new Table($output);

        $routes = $this->slim->getRouteCollector()->getRoutes();

        $collected = [];

        foreach ($routes as $route) {
            $collected[] = [
                implode(',', $route->getMethods()),
                $route->getPattern(),
                $route->getCallable(),
                $route->getName(),
                implode(',', $route->getArguments())
            ];
        }
        $table->setHeaders(
            ['Methods', 'Path', 'Callable', 'Name', 'Args']
        )->setRows($collected);

        $table->render();

        return Command::SUCCESS;
    }
}

