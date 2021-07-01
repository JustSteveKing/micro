<?php

declare(strict_types=1);

namespace Infrastructure\Database;

use Domain\User\Contracts\UserRepositoryContract;
use Domain\User\Contracts\UserServiceContract;

class DoctrineUserServiceContract implements UserServiceContract
{
    public function __construct(
        private UserRepositoryContract $repository,
    ) {}

    public function listAllUsers(array $columns): array
    {
        return $this->repository->get(
            columns: $this->implode(
                columns: $columns,
            ),
        );
    }

    public function findUserWithId(string|int $id, array $columns): array
    {
        return $this->repository->whereId(
            id: $id,
            columns: $this->implode(
                columns: $columns,
            ),
        );
    }

    private function implode(array $columns, string $separator = ', '): string
    {
        return implode($separator, $columns);
    }
}
