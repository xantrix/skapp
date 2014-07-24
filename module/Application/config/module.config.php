<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return [
    'asset_manager' => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../asset/dist',
            ],
        ],
    ],
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
        'webPath'        => 'public/_/assets',
        'basePath'       => '/_/assets',
        'default'         => [
            'assets' => [
                '@application_css',
                '@application_js'
            ],
        ],

        'modules'        => [
            'application' => [
                'root_path'   => __DIR__ . '/../assets',
                'collections' => [
                    'application_less' => [
                        'assets'  => [
                            'less/style.less'
                        ],
                        'filters' => [
                            'LessphpFilter' => [
                                'name' => 'Assetic\Filter\LessphpFilter'
                            ],

                        ],
                    ],
                    'application_fonts' => [
                        'assets' => [
                            __DIR__ . '/../../../vendor/fortawesome/font-awesome/fonts/*'
                        ],
                        'options' => [
                            'move_raw' => true,
                        ],
                    ],
                    'application_compatibility' => [
                        'assets' => [
                            __DIR__ . '/../../../vendor/afarkas/html5shiv/dist/*',
                            __DIR__ . '/../../../vendor/rogeriopradoj/respond/dest/*',
                        ],
                        'options' => [
                            'move_raw' => true
                        ],
                    ],
                    'application_css'  => [
                        'assets'  => [
                            '@application_less'
                        ],
                        'filters' => [
                            'CssRewriteFilter' => [
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ],
                            '?CssMinFilter' => [
                                'name' => 'Assetic\Filter\CssMinFilter'
                            ],
                        ],
                        'options' => [
                            'output' => 'application.css'
                        ],
                    ],
                    'application_js'          => [
                        'assets' => [
                            __DIR__ . '/../../../vendor/components/jquery/jquery.js',
                            __DIR__ . '/../../../vendor/twbs/bootstrap/dist/js/bootstrap.js',
                        ],
                        'filters' => [
                            '?JSMinFilter' => [
                                'name' => 'Assetic\Filter\JSMinFilter'
                            ],
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
