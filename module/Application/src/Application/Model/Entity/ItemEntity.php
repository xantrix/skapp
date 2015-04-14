<?php
namespace Application\Model\Entity;

use Application\Model\AbstractEntity;
use Application\Model\DateAwareTrait;
use User\Model\Entity\UserEntity;
use Application\Model\DateAwareInterface;

class ItemEntity extends AbstractEntity implements ItemInterface, DateAwareInterface 
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
     * @var string
     */
    protected $userId;    
    
	/**
	 * @return the $userId
	 */
	public function getUserId() {
		return $this->userId;
	}

	/**
	 * @param string $userId
	 */
	public function setUserId($userId) {
		$this->userId = $userId;
	}

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
		//return $this->user;
	}
	
}

