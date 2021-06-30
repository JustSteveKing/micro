<?php

declare(strict_types=1);

namespace App\Console\Migrations;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DiffCommand extends Command
{
    protected static $defaultName = 'migrate:diff';

    protected static $defaultDescription = 'Create a migration as a diff of two existing database structures.';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $process = new Process(
            command: ['php', './vendor/bin/phoenix', 'diff'],
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