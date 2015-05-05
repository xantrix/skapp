<?php
namespace User\Model\Assertion\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use User\Model\Assertion\CheckMyProfile;

class CheckMyProfileFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return CheckMyProfile
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
    	$loggedUser = $serviceLocator->get('AuthModule\AuthenticationService')->getIdentityObject();
        return new CheckMyProfile($loggedUser);
    }	
}

