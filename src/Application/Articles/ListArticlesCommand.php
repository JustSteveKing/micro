<?php

declare(strict_types=1);

namespace App\Articles;

class ListArticlesCommand
{
    public function columns(): array
    {
        return [
            'uuid',
            'title',
            'slug',
            'user_id'
        ];
    }
}
