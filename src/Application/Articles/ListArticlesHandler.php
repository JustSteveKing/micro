<?php

declare(strict_types=1);

namespace App\Articles;

use Doctrine\DBAL\Connection;

class ListArticlesHandler
{
    public function __construct(
        private Connection $connection,
    ) {}

    public function handle(ListArticlesCommand $command): array
    {
        $statement = $this->connection->prepare(
            sql: 'SELECT ' . implode(', ', $command->columns()) .' FROM articles',
        );

        return $statement->executeQuery()->fetchAllAssociative();
    }
}
