<?php
namespace User\Model\Object\Role;

/**
 * RoleInterface
 */
interface RoleInterface {
	
	/**
	 * @return the $roleId
	 */
	public function getRoleId();

	/**
	 * @param string $roleId
	 */
	public function setRoleId($roleId);
		
}
