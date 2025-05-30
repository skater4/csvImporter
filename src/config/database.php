<?php

return [
    'host'    => getenv('DB_HOST') ?: 'mariadb',
    'driver'  => getenv('DB_DRIVER') ?: 'mysql',
    'dbname'  => getenv('DB_DATABASE') ?: 'store',
    'user'    => getenv('DB_USERNAME') ?: 'root',
    'pass'    => getenv('DB_PASSWORD') ?: 'root',
    'charset' => getenv('DB_CHARSET') ?: 'utf8mb4',
];
