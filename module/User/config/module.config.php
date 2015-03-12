<?php
return [
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