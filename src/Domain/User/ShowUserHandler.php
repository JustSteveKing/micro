<?php

declare(strict_types=1);

namespace Domain\User;

class ShowUserHandler
{
    public function __construct(
        private UserService $service,
    ) {}

    public function handle(ShowUserQuery $command): array
    {
        return $this->service->findUserWithId(
            id: $command->id(),
            columns: $command->columns(),
        );
    }
}
