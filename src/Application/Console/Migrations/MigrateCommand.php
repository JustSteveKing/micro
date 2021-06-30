<?php

declare(strict_types=1);

namespace App\Console\Migrations;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class MigrateCommand extends Command
{
    protected static $defaultName = 'migrate:run';

    protected static $defaultDescription = 'Run the database migrations.';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process(
            command: ['php', './vendor/bin/phoenix', 'migrate'],
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
