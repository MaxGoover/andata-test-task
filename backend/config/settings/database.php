<?php

declare(strict_types=1);

return [
    'pdo' => function () {
        $dsn = 'mysql:host=' . $_ENV['MYSQL_HOST'] .
            ';dbname=' . $_ENV['MYSQL_DATABASE'] .
            ';charset=' . $_ENV['MYSQL_CHARSET'];
        return new PDO(
            $dsn,
            $_ENV['MYSQL_ROOT_USER'],
            $_ENV['MYSQL_ROOT_PASSWORD'],
        );
    },
];
