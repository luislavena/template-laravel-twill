<?php

return [
    'global' => [
        'title' => 'Global',
        'route' => 'admin.global.pages.index',
        'primary_navigation' => [
            'pages' => [
                'title' => 'Generic Pages',
                'module' => true,
            ],
        ],
    ],

    'config' => [
        'title' => 'Configuration',
        'route' => 'admin.config.featureFlags.index',
        'primary_navigation' => [
            'featureFlags' => [
                'title' => 'Feature Flags',
                'route' => 'admin.config.featureFlags.index',
            ],
        ],
    ],
];
