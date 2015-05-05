<?php
return [
    'authentication' => [
        'adapter'   => 'User\Authentication\AuthModelAdapter',
    ],
    'service_manager'   => [
    	'invokables' => [
			
		],
        'factories' => [
            'User\Authentication\AuthModelAdapter' => 'User\Authentication\AuthModelAdapterFactory',
            'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider' => 'User\Model\Service\AuthenticationIdentityProviderServiceFactory',
            'assertion.CheckMyProfile' => 'User\Model\Assertion\Service\CheckMyProfileFactory'            
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