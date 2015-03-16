<?php
namespace User\Authentication;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AuthModule\Adapter\ModelAdapter;

class AuthModelAdapterFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new ModelAdapter(
            $serviceLocator->get('Matryoshka\Model\ModelManager')->get('User\Model\UserModel')
        );
    }
}