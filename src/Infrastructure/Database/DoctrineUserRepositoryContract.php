<?php

declare(strict_types=1);

namespace Infrastructure\Database;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Query\QueryBuilder;
use Domain\User\Contracts\UserRepositoryContract;

class DoctrineUserRepositoryContract implements UserRepositoryContract
{
    private string $table = 'users';

    private QueryBuilder $builder;

    public function __construct(Connection $connection)
    {
        $this->builder = $connection->createQueryBuilder();
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        // TODO: Implement count() method.
    }

    public function find(int|string $id, array $columns = ['*'])
    {
        return $this->builder
            ->select(implode(',', $columns))
            ->from('users')
            ->where('id = :id')
            ->setParameter(':id', $id)
            ->execute()
            ->fetch();
    }

    public function get(string $columns = '*'): array
    {
        return $this->builder
            ->select($columns)
            ->from($this->table)
            ->execute()
            ->fetchAllAssociative();
    }

    public function whereId(string|int $id, string $columns = '*'): array
    {
        return $this->builder
            ->select($columns)
            ->from($this->table)
            ->where('id = :id')
            ->setParameter(':id', $id)
            ->execute()
            ->fetchAssociative();
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}