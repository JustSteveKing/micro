<?php

declare(strict_types=1);

namespace Domain\User;

class ShowUserQuery
{
    public function __construct(
        private string|int $id,
    ) {}

    public function columns(): array
    {
        return [
            'id',
            'name',
            'email',
        ];
    }

    public function id(): string|int
    {
        return $this->id;
    }
}
