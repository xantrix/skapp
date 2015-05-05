<?php
namespace User\Model\Assertion;

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Resource\ResourceInterface;
use Zend\Permissions\Acl\Role\RoleInterface;
use Zend\Permissions\Acl\Assertion\AssertionInterface;
use User\Model\Entity\UserEntity;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;

/**
 * Example at https://github.com/bjyoungblood/BjyAuthorize/issues/250
 */
class CheckMyProfile implements AssertionInterface, EventManagerAwareInterface
{
	use EventManagerAwareTrait;
	
    private $loggedUser;
    
    public function __construct($loggedUser) {
        
    	$this->loggedUser  = $loggedUser;
    }
    
    public function setLoggedUser($loggedUser)
    {
    	$this->loggedUser  = $loggedUser;
    }
    
    public function assert(Acl $acl,
                           RoleInterface $role = null,
                           ResourceInterface $resource = null,
                           $privilege = null)
    {
		//$this->getEventManager()->trigger('assert.pre', $this, []);
        
        if ($resource instanceof UserEntity) {
            return $resource->getId() == $this->loggedUser->getId();
        } else {
            return false;
        }
        
    }
    
    /**
     * avoid exception during acl serialization 
     * @return multitype:
     */
    public function __sleep()
    {
        return array();
    }    
}