<?php

declare(strict_types=1);

namespace Domain\User\Handlers;

use Domain\User\Queries\ShowUserQuery;
use Domain\User\Contracts\UserServiceContract;

class ShowUserHandler
{
    public function __construct(
        private UserServiceContract $service,
    ) {}

    public function handle(ShowUserQuery $command): array
    {
        return $this->service->findUserWithId(
            id: $command->id(),
            columns: $command->columns(),
        );
    }
}
