<?php
namespace Application\Model\Entity;

use Application\Model\AbstractEntity;
use Application\Model\DateAwareTrait;
use User\Model\Entity\UserEntity;

class ItemEntity extends AbstractEntity implements ItemInterface 
{
	use DateAwareTrait;
	
    /**
     * @var string
     */
    protected $id;
    
    /**
     * @var string
     */
    protected $name;    
    
    /**
     * @var User
     */
    protected $user;    
    
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId($id) {
		$this->id = $id;
	}
	    
	/**
	 * @return UserEntity
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @param UserEntity $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}
	
}

