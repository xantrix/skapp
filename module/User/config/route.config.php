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
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
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
                            'route'       => '/[:controller[/:action]]',
                            'constraints' => [
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ],
                            'defaults'    => [],
                        ],
                    ],
                ],
            ],
        ],
    ],

    // Console routes
    'console' => [
        'router' => [
            'routes' => [],
        ],
    ],
];