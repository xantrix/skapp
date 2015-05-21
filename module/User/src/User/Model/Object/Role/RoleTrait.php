<?php
namespace User\Model\Object\Role;

trait RoleTrait {
	
	/**
	 * @var string
	 */
	protected $roleId;
	
	public function __construct($roleId = null){
		$this->roleId = $roleId;
	}
	
	/**
	 * @return the $roleId
	 */
	public function getRoleId() {
		return $this->roleId;
	}

	/**
	 * @param string $roleId
	 */
	public function setRoleId($roleId) {
		$this->roleId = $roleId;
	}
	
 	public function toArray(){
        return [
			'role_id' => $this->getRoleId()
        ];
     }	
	
}
