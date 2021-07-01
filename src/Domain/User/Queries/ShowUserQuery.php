<?php

declare(strict_types=1);

namespace Domain\User\Queries;

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
            'username',
            'created_at'
        ];
    }

    public function id(): string|int
    {
        return $this->id;
    }
}
