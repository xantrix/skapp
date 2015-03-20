<?php
namespace User\Model\Validator;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Model\Criteria\UserCollectionCriteria;
use Zend\ServiceManager\AbstractPluginManager;

class NoIdentityExistsFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceManager = $serviceLocator;
        if ($serviceManager instanceof AbstractPluginManager) {
            $serviceManager = $serviceManager->getServiceLocator();
        }
        // TODO: it could be improved using configuration
        $validator = new NoIdentityExists();
        $validator->setCriteria(new UserCollectionCriteria());
        $validator->setModel(
            $serviceManager->get('Matryoshka\Model\ModelManager')->get('User\Model\UserModel')
        );

        return $validator;
    }

}