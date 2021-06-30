<?php

declare(strict_types=1);

return [
    'migration_dirs' => [
        'first' => __DIR__ . '/database/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'root',
            'db_name' => 'micro',
            'charset' => 'utf8mb4',
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'migration_log',
];
