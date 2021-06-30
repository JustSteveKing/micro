<?php

declare(strict_types=1);

namespace App\Console\Migrations;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class RollbackCommand extends Command
{
    protected static $defaultName = 'migrate:rollback';

    protected static $defaultDescription = 'Rollback the database migrations.';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process(
            command: ['php', './vendor/bin/phoenix', 'rollback'],
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