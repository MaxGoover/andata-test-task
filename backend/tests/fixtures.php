<?php

declare(strict_types=1);

// Фикстуры для тестов
return [
    'fixture' => [
        'article' => [
            'create' => [
                'author_email' => 'backend_maxgoover@gmail.com',
                'author_username' => 'BackendMaxGoover',
                'content' => 'Бэкэнд - тестовое содержание тестовой статьи',
                'title' => 'Бэкэнд - тестовый заголовок тестовой статьи',
            ],
            'update' => [
                'author_email' => 'updated_backend_maxgoover@gmail.com',
                'author_username' => 'UpdatedBackendMaxGoover',
                'content' => 'Измененное Бэкэнд - содержание тестовой статьи',
                'title' => 'Измененный Бэкэнд - заголовок тестовой статьи',
            ],
        ],
        'comment' => [
            'create' => [
                'article_id' => null,
                'author_email' => 'backend_maxgoover@gmail.com',
                'author_username' => 'BackendMaxGoover',
                'content' => 'Бэкэнд - тестовое содержание тестового комментария',
                'title' => 'Бэкэнд - тестовый заголовок тестового комментария',
            ],
            'update' => [
                'article_id' => null,
                'author_email' => 'updated_backend_maxgoover@gmail.com',
                'author_username' => 'UpdatedBackendMaxGoover',
                'content' => 'Измененное Бэкэнд - содержание тестового комментария',
                'title' => 'Измененный Бэкэнд - заголовок тестового комментария',
            ],
        ],
    ],
];
