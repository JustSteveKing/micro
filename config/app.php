<?php

declare(strict_types=1);

return [
    'name' => $_ENV['APP_NAME'],

    'console' => [
        'commands' => [
            \App\Console\RouteListCommand::class,
            \App\Console\FindUserByIdCommand::class,
        ]
    ]
];
