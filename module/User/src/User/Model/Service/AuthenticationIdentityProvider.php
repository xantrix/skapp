<?php
namespace User\Model\Service;

use BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider as BjyAuthorizeAuthenticationIdentityProvider;
use BjyAuthorize\Provider\Role\ProviderInterface as RoleProviderInterface;
use Zend\Permissions\Acl\Role\RoleInterface;

class AuthenticationIdentityProvider extends BjyAuthorizeAuthenticationIdentityProvider
{
    /**
     * {@inheritDoc}
     */
    public function getIdentityRoles()
    {
        if (! $identity = $this->authService->getIdentity()) {
            return array($this->defaultRole);
        }

        //if user logged get user object from authService
        $identity = $this->authService->getIdentityObject();
        if ($identity instanceof RoleInterface) {
            return array($identity);
        }

        if ($identity instanceof RoleProviderInterface) {
            return $identity->getRoles();
        }

        return array($this->authenticatedRole);
    }	
}

