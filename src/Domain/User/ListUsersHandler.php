<?php

declare(strict_types=1);

namespace Domain\User;

use Infrastructure\Database\UserRepository;

class ListUsersHandler
{
    public function __construct(
        private UserRepository $repository,
    ) {}

    public function handle(ListUsersQuery $command): array
    {
        return $this->repository->find(
            id: 1,
            columns: $command->columns(),
        );
    }
}
