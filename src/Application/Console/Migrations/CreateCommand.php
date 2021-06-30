<?php

declare(strict_types=1);

namespace App\Console\Migrations;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class CreateCommand extends Command
{
    protected static $defaultName = 'migrate:create';

    protected static $defaultDescription = 'Create a new database migration.';

    protected function configure()
    {
        $this->addArgument(
            name: 'name',
            mode: InputArgument::REQUIRED,
            description: 'The name of the migration you want to create.',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process(
            command: ['php', './vendor/bin/phoenix', 'create', $input->getArgument('name')],
        );

        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException(
                process: $process
            );
        }

        echo $process->getOutput();

        return Command::SUCCESS;
    }
}