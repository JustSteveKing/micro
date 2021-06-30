<?php

declare(strict_types=1);

return [
    'driver' => $_ENV['DB_DRIVER'],
    'host' => $_ENV['DB_HOST'],
    'dbname' => $_ENV['DB_NAME'],
    'user' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'driverOptions' => [
        // Turn off persistent connections.
        PDO::ATTR_PERSISTENT => false,
        // Enable Exceptions.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements.
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array.
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set.
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET Names utf8mb4 COLLATE utf8mb4_unicode_ci',
    ]
];
