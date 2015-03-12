<?php
namespace User;

use Zend\Mvc\MvcEvent;
use Zend\Stdlib\ArrayUtils;

class Module
{
    
	public function onBootstrap(MvcEvent $e)
    {
    }    
	
	public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/route.config.php');
        return $config;
    }

    public function getViewHelperConfig()
    {
        return include __DIR__ . '/config/viewhelper.config.php';
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
