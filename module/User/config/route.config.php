<?php
return [
    'router' => [
        'routes' => [
            'user-home'        => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/user',
                    'defaults' => [
                        'controller' => 'User\Controller\User',
                        'action'     => 'index',
                    ],
                ],
            ],
            'login'        => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/user/login',
                    'defaults' => [
                        'controller' => 'User\Controller\User',
                        'action'     => 'login',
                    ],
                ],
            ],
            'registration'        => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/user/registration',
                    'defaults' => [
                        'controller' => 'User\Controller\User',
                        'action'     => 'registration',
                    ],
                ],
            ],
            'user' => [
                'type'          => 'Literal',
                'options'       => [
                    'route'    => '/user',
                    'defaults' => [
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'User',
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => false,
                'child_routes'  => [
                    'default' => [
                        'type'    => 'Segment',
                        'options' => [
                            'route'       => '[/:action]',
                            'constraints' => [
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
                            ],
                            'defaults'    => [],
                        ],
                    ],
		            'recover-password'        => [
		                'type'    => 'Zend\Mvc\Router\Http\Literal',
		                'options' => [
		                    'route'    => '/recover-password',
		                    'defaults' => [
		                        'action'     => 'recover-password',
		                    ],
		                ],
		            ],
		            'admin' => [
		                'type'          => 'Literal',
		                'options'       => [
		                    'route'    => '/admin',
		                    'defaults' => [
		                        'controller'    => 'Admin',
		                        'action'        => 'index',
		                    ],
		                ],
		                'may_terminate' => false,
		                'child_routes'  => [
		                    'default' => [
		                        'type'    => 'Segment',
		                        'options' => [
		                            'route'       => '[/:action]',
		                            'constraints' => [
		                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
		                            ],
		                            'defaults'    => [],
		                        ],
		                    ],
		                ],
		            ],//admin		                                
                ],//user->child
            ],//user
        ],
    ],

    // Console routes
    'console' => [
        'router' => [
            'routes' => [],
        ],
    ],
];