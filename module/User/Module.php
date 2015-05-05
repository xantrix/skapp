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
    	$serviceManager      = $e->getApplication()->getServiceManager();
    	$sharedManager = $e->getApplication()->getEventManager()->getSharedManager();
    	//$eventManager = $e->getApplication()->getEventManager();        
        
    	//if cached in persistent storage, fill Assertion object after wakeup
//     	$sharedManager->attach('User\Model\Assertion\CheckMyProfile', 'assert.pre', function($event) use ($serviceManager){
// 			$target = $event->getTarget();
//     		$loggedUser = $serviceManager->get('AuthModule\AuthenticationService')->getIdentityObject();
//     		$target->setLoggedUser($loggedUser);
//     		//$event->getParam('param1');
//     	});    	
    }

	public function getConfig()
    {
        $config = include __DIR__ . '/config/module.config.php';
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/route.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/model.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/listener.config.php');
        $config = ArrayUtils::merge($config, include __DIR__ . '/config/bjyauthorize.config.php');
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
