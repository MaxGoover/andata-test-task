<?php

declare(strict_types=1);

return [
    'validation' => [
        'article' => [
            'content' => [
                'minLength' => 10,
                'maxLength' => 10000,
            ],
            'title' => [
                'minLength' => 3,
                'maxLength' => 200,
            ],
        ],
        'comment' => [
            'content' => [
                'minLength' => 10,
                'maxLength' => 10000,
            ],
            'title' => [
                'minLength' => 3,
                'maxLength' => 100,
            ],
        ],
        'date' => [
            'format' => 'Y-m-d H:i:s',
        ],
        'email' => [
            'maxLength' => 320,
        ],
        'username' => [
            'minLength' => 3,
            'maxLength' => 100,
        ],
    ],
];
