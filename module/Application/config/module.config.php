<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'service_manager'       => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'factories' => [
            'Zend\Session\SessionManager' => 'Zend\Session\Service\SessionManagerFactory',
            'SphinxSearch\Db\Adapter\Adapter' => 'SphinxSearch\Db\Adapter\AdapterServiceFactory',
        ],
        'aliases'            => [
            'translator' => 'MvcTranslator',
            'sphinxql' => 'SphinxSearch\Db\Adapter\Adapter',
        ],
    ],
    'translator'            => [
        'locale'                    => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'controllers'           => [
        'invokables' => [
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ],
    ],
    'view_manager'          => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],

    'assetic_configuration' => [
        'webPath'        => 'public/_/asset/application',
        'basePath'       => '/_/asset/application',
        'modules'        => [
            'application_asset' => [
                'root_path'   => __DIR__ . '/../asset/dist/application',
                'collections' => [
                    'application' => [
                        'assets' => [
                            'css/application.css',
                            'js/application.js',
                            'fonts/*'
                        ],
                        'options' => [
                            'move_raw' => true
                        ],
                    ],
                ],
            ],
        ],
    ],

    'hanger_snippet' => [
        'snippets' => [
            'google-analytics' => [
                'config_key' => 'ga', //the config node in the global config, if any
            ],
            'facebook-sdk' => [
                'config_key' => 'facebook', //the config node in the global config, if any
                'values' => [
                    'status' => true,
                    'xfbml'  => false,
                ],
            ],
        ],
    ],
];
