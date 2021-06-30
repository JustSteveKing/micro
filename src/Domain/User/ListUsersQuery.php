<?php

declare(strict_types=1);

namespace Domain\User;

class ListUsersQuery
{
    public function columns(): array
    {
        return [
            'id',
            'name',
        ];
    }
}
