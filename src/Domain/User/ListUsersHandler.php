<?php

declare(strict_types=1);

namespace Domain\User;

class ListUsersHandler
{
    public function __construct(
        private UserService $service,
    ) {}

    public function handle(ListUsersQuery $command): array
    {
        return $this->service->listAllUsers(
            columns: $command->columns(),
        );
    }
}
