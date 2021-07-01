<?php

declare(strict_types=1);

namespace Domain\User\Queries;

class ListUsersQuery
{
    public function columns(): array
    {
        return [
            'id',
            'name',
            'email',
        ];
    }
}
