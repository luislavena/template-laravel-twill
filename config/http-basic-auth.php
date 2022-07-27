<?php

return [
    'enabled' => env('HTTP_BASIC_AUTH_ENABLED', true),

    'username' => env('HTTP_BASIC_USERNAME', 'username'),

    'password' => env('HTTP_BASIC_PASSWORD', 'passw0rt'),

    'routes' => [
        'ignore' => [
            'paths' => ['/admin/*', '/api/v1/*'],
        ],
    ],
];
