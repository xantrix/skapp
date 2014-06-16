<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router'                => array(
        'routes' => array(
            'home'        => array(
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'application' => array(
                'type'          => 'Literal',
                'options'       => array(
                    'route'    => '/application',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Application\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => false,
                'child_routes'  => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'       => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults'    => array(),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager'       => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'Zend\Session\SessionManager' => 'Zend\Session\Service\SessionManagerFactory',
            'SphinxSearch\Db\Adapter\Adapter' => 'SphinxSearch\Db\Adapter\AdapterServiceFactory',
        ),
        'aliases'            => array(
            'translator' => 'MvcTranslator',
            'sphinxql' => 'SphinxSearch\Db\Adapter\Adapter',
        ),
    ),
    'translator'            => array(
        'locale'                    => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers'           => array(
        'invokables' => array(
            'Application\Controller\Index' => 'Application\Controller\IndexController'
        ),
    ),
    'view_manager'          => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack'      => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),

    'assetic_configuration' => array(
        'webPath'        => 'public/_/assets',
        'basePath'       => '/_/assets',
        'default'         => array(
            'assets' => array(
                '@application_css',
                '@application_js'
            ),
        ),

        'modules'        => array(
            'application' => array(
                'root_path'   => __DIR__ . '/../assets',
                'collections' => array(
                    'application_less' => array(
                        'assets'  => array(
                            'less/style.less'
                        ),
                        'filters' => array(
                            'LessphpFilter' => array(
                                'name' => 'Assetic\Filter\LessphpFilter'
                            ),

                        ),
                    ),
                    'application_fonts' => array(
                        'assets' => array(
                            __DIR__ . '/../../../vendor/fortawesome/font-awesome/fonts/*'
                        ),
                        'options' => array(
                            'move_raw' => true,
                        )
                    ),
                    'application_compatibility' => array(
                        'assets' => array(
                            __DIR__ . '/../../../vendor/afarkas/html5shiv/dist/*',
                            __DIR__ . '/../../../vendor/rogeriopradoj/respond/dest/*',
                        ),
                        'options' => array(
                            'move_raw' => true
                        )
                    ),
                    'application_css'  => array(
                        'assets'  => array(
                            '@application_less'
                        ),
                        'filters' => array(
                            'CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            )


                        ),
                        'options' => array(
                            'output' => 'application.css'
                        )
                    ),
                    'application_js'          => array(
                        'assets' => array(
                            __DIR__ . '/../../../vendor/components/jquery/jquery.js',
                            __DIR__ . '/../../../vendor/twbs/bootstrap/dist/js/bootstrap.js',
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            )
                        )
                    ),
                ),
            ),
        ),
    ),

    'hanger_snippet' => array(
        'snippets' => array(
            'google-analytics' => array(
                'config_key' => 'ga', //the config node in the global config, if any
            ),
            'facebook-sdk' => array(
                'config_key' => 'facebook', //the config node in the global config, if any
                'values' => array(
                    'status' => true,
                    'xfbml'  => false,
                ),
            )
        ),
    ),

    // Placeholder for console routes
    'console'               => array(
        'router' => array(
            'routes' => array(),
        ),
    ),
);
