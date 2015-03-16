<?php
return [
    'authentication' => [
        'adapter'   => 'User\Authentication\AuthModelAdapter',
    ],
    'service_manager'   => [
        'factories' => [
            'User\Authentication\AuthModelAdapter' => 'User\Authentication\AuthModelAdapterFactory',
        ],
    ],
    'controllers'           => [
        'invokables' => [
            'User\Controller\User' => 'User\Controller\UserController'
        ],
    ],
    'view_manager'          => [
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
];