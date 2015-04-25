<?php
namespace User\Model\Object\Role;

use Application\Model\AbstractObject;
use Zend\Permissions\Acl\Role\RoleInterface as ZendAclRoleInterface;

/**
 * Class RoleObject
 */
class RoleObject extends AbstractObject implements ZendAclRoleInterface, RoleInterface
{
    use RoleTrait;
}
