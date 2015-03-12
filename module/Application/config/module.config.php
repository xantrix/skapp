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
            'Matryoshka\Model\Wrapper\Mongo\Service\MongoDbAbstractServiceFactory',
            'Matryoshka\Model\Wrapper\Mongo\Service\MongoCollectionAbstractServiceFactory',
        ],
        'factories' => [
            'Zend\Session\SessionManager' => 'Zend\Session\Service\SessionManagerFactory',
            'SphinxSearch\Db\Adapter\Adapter' => 'SphinxSearch\Db\Adapter\AdapterServiceFactory',
        ],
        'invokables'         => [
            // Default ResultSet
            'Matryoshka\Model\Wrapper\Mongo\ResultSet\HydratingResultSet' => 'Matryoshka\Model\Wrapper\Mongo\ResultSet\HydratingResultSet',

            // Default criterias
            'Matryoshka\Model\Wrapper\Mongo\Criteria\ActiveRecord\ActiveRecordCriteria' => 'Matryoshka\Model\Wrapper\Mongo\Criteria\ActiveRecord\ActiveRecordCriteria',
            'Matryoshka\Model\Wrapper\Mongo\Criteria\FindAllCriteria' => 'Matryoshka\Model\Wrapper\Mongo\Criteria\FindAllCriteria',
        ],
        'aliases'            => [
            'translator' => 'MvcTranslator',
            'sphinxql' => 'SphinxSearch\Db\Adapter\Adapter',
        ],
        'shared' => [
            'Matryoshka\Model\Wrapper\Mongo\ResultSet\HydratingResultSet'                           => false,
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
        'modules'        => [
            'application_asset' => [
                'root_path'   => __DIR__ . '/../asset/dist',
                'collections' => [
                    'application' => [
                        'assets' => [
                            'application/css/*',
                            'application/js/*',
                            'application/fonts/*'
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
    	'enable_all' => false,
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
