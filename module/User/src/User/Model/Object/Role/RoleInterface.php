<?php
namespace User\Model\Object\Role;

/**
 * RoleInterface
 */
interface RoleInterface {
	
	const ROLE_USER = 'user';
	const ROLE_ADMIN = 'admin';
	const ROLE_B2B = 'b2b';
	const ROLE_OTHER = 'other';
	
	/**
	 * @return the $roleId
	 */
	public function getRoleId();

	/**
	 * @param string $roleId
	 */
	public function setRoleId($roleId);
		
}
