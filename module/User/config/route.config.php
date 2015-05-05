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
		            'recover-password'        => [
		                'type'    => 'Zend\Mvc\Router\Http\Literal',
		                'options' => [
		                    'route'    => '/recover-password',
		                    'defaults' => [
		                        'action'     => 'recover-password',
		                    ],
		                ],
		            ],
		            'profile'        => [
		                'type'    => 'Segment',
		                'options' => [
		                    'route'    => '/profile/:id',
                            'constraints' => [
                                'id'     => '[a-zA-Z0-9_-]*'
                            ],		                    
		                    'defaults' => [
		                        'action'     => 'profile',
		                    ],
		                ],
		            ],
		            'profile-edit'        => [
		                'type'    => 'Segment',
		                'options' => [
		                    'route'    => '/profile/:id/edit',
                            'constraints' => [
                                'id'     => '[a-zA-Z0-9_-]*'
                            ],		                    
		                    'defaults' => [
		                        'action'     => 'profile-edit',
		                    ],
		                ],
		            ],		            
		            'logout'        => [
		                'type'    => 'Zend\Mvc\Router\Http\Literal',
		                'options' => [
		                    'route'    => '/logout',
		                    'defaults' => [
		                        'action'     => 'logout',
		                    ],
		                ],
		            ],		            		            
		            'admin' => [
		                'type'          => 'Literal',
		                'options'       => [
		                    'route'    => '/admin',
		                    'defaults' => [
		                        'controller'    => 'User',
		                        'action'        => 'admin-only',
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