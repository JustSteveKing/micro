<?php

declare(strict_types=1);

namespace Domain\User\Handlers;

use Domain\User\Queries\ListUsersQuery;
use Domain\User\Contracts\UserServiceContract;

class ListUsersHandler
{
    public function __construct(
        private UserServiceContract $service,
    ) {}

    public function handle(ListUsersQuery $command): array
    {
        return $this->service->listAllUsers(
            columns: $command->columns(),
        );
    }
}
