<?php
namespace User;

use Zend\Mvc\MvcEvent;
use Zend\Stdlib\ArrayUtils;
use Zend\ModuleManager\Feature\ValidatorProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

class Module implements ValidatorProviderInterface, ViewHelperProviderInterface
{

	public function onBootstrap(MvcEvent $e)
    {
    }

	public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/route.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/model.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/listener.config.php');
        return $config;
    }

    /**
     * {inheritdoc}
     */
    public function getViewHelperConfig()
    {
        return include __DIR__ . '/config/viewhelper.config.php';
    }

    /**
     * {inheritdoc}
     */
    public function getValidatorConfig()
    {
        return include __DIR__ . '/config/validator.config.php';
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
