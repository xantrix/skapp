<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Console\Console;
use Zend\Session\SaveHandler\MongoDBOptions;
use Zend\Stdlib\ArrayUtils;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ViewHelperProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $serviceManager      = $e->getApplication()->getServiceManager();
        $config              = $serviceManager->get('Config');
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        if (!Console::isConsole()) {
            $e->getRequest()->setBaseUrl($config['application']['base_url']);
            $this->bootstrapSession($e);
        }
    }

    public function bootstrapSession($e)
    {
        $session = $e->getApplication()->getServiceManager()->get('Zend\Session\SessionManager');
        $session->start();

        $container = new Container('initialized');
        if (!isset($container->init)) {
            $session->regenerateId(true);
            $container->init = 1;
        }
    }

    public function getServiceConfig()
    {
         return [
            'aliases' => [
                'Zend\Session\SaveHandler\SaveHandlerInterface' => 'Zend\Session\SaveHandler\MongoDB',
                'Zend\Session\Storage\StorageInterface' => 'Zend\Session\Storage\SessionArrayStorage',
            ],

            'invokables' => [
                'Zend\Session\Storage\SessionArrayStorage' => 'Zend\Session\Storage\SessionArrayStorage',
            ],

            'factories' => [

                'Zend\Session\Config\ConfigInterface' => 'Zend\Session\Service\SessionConfigFactory',
                'Zend\Session\SessionManager' => 'Zend\Session\Service\SessionManagerFactory',

                'Zend\Session\SaveHandler\MongoDB' => function ($sm) {
                        $config = $sm->get('Config');
                        $config = $config['session_save_handler_mongo'];

                        $hosts = array_key_exists('hosts', $config) ? $config['hosts'] : 'localhost:27017';
                        unset($config['hosts']);

                        $credential = array_key_exists('username', $config) &&
                        array_key_exists('password', $config) ?
                            "{$config['username']}:{$config['password']}@" :
                            null;

                        unset($config['username'], $config['password']);

                        $options = array_key_exists('options', $config) && is_array($config['options']) ?
                            $config['options'] :
                            [];

                        unset($config['options']);

                        $client = new \MongoClient("mongodb://{$credential}{$hosts}", $options);
                        $saveHandlerConfig = new MongoDBOptions($config);
                        $saveHandlerConfig->setSaveOptions(['w' => 1]);
                        $sessionHandler = new \Zend\Session\SaveHandler\MongoDB($client, $saveHandlerConfig);

                        return $sessionHandler;
                    },
            ],
        ];
    }

    public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/route.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/model.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/imgman.config.php');
        return $config;
    }

    public function getViewHelperConfig()
    {
        return include __DIR__ . '/config/viewhelper.config.php';
    }

    public function getControllerPluginConfig()
    {
    	return include __DIR__ . '/config/controllerplugin.config.php';
    }
    
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__),
                ],
            ],
        ];
    }
}
