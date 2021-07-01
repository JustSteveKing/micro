<?php

declare(strict_types=1);

namespace App\Console;

use Domain\User\Queries\ShowUserQuery;
use League\Tactician\CommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class FindUserByIdCommand extends Command
{
    protected static $defaultName = 'users:by-id';

    protected static $defaultDescription = 'Find a specific user by their ID.';

    public function __construct(
        private CommandBus $bus,
        string $name = null,
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $query = new ShowUserQuery(
            id: '51',
        );

        $user = $this->bus->handle(
            command: $query,
        );

        $table = new Table($output);

        $table->setHeaders(
            $query->columns(),
        )->setRows([$user]);

        $table->render();

        return Command::SUCCESS;
    }
}
