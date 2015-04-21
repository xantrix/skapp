<?php
namespace Application\Controller\Plugin\Service;
 
use Zend\ServiceManager\AbstractFactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Application\Controller\Plugin\Service\MongoIdShortInterface;
 
class MongoIdShortAbstractFactory implements AbstractFactoryInterface
{
	const NAME_SHORT = 'id2Short';
	const NAME_NORMAL = 'id2Normal';	
	
    public function canCreateServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
        return $requestedName === self::NAME_NORMAL || $requestedName === self::NAME_SHORT;
    }
 
    /**
     * create view helper or controller plugin
     * @see \Zend\ServiceManager\AbstractFactoryInterface::createServiceWithName()
     */
    public function createServiceWithName(ServiceLocatorInterface $locator, $name, $requestedName)
    {
    	if($locator instanceof \Zend\View\HelperPluginManager){
    		$class = 'Application\View\Helper\MongoIdShort';
    	}else{
    		$class = 'Application\Controller\Plugin\MongoIdShort';
    	}
    	
    	if($requestedName === self::NAME_NORMAL){
        	return new $class(MongoIdShortInterface::MODE_NORMAL);
        }else{
        	return new $class(MongoIdShortInterface::MODE_SHORT);
        }
    }
}