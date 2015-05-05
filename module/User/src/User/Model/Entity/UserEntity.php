<?php
namespace User\Model\Entity;

use Application\Model\AbstractEntity;
use Zend\Crypt\Password\Bcrypt;
use Application\Model\DateAwareTrait;
use AuthModule\Identity\ObjectInterface as AuthObjectInterface;
use Application\Model\Object\Address\AddressObject;
use ArrayObject;
use User\Model\Object\Role\Collection\RoleCollection;
use User\Model\Object\Role\RoleObject;
use User\Model\Object\Role\RoleInterface;

class UserEntity extends AbstractEntity implements UserInterface, AuthObjectInterface
{
    use DateAwareTrait;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
     protected $status;

    /**
     * Runtime only, must not saved
     * @var string
     */
    protected $password;

    /**
     * @var string 64 byte
     */
    protected $passwordCrypt;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $userName;

    /**
     * @var RoleCollection
     */
    protected $roles;

    /**
     * @var string
     */
    protected $registrationToken;

    /**
     * @var string
     */
    protected $recoverPasswordToken;

    /**
     * @var string
     */
    protected $language;
	
	/**
	 * @var AddressObject
	 */
	protected $address;
	
	/**
	 * date of birth
	 * @var DateTime
	 */
	protected $dob;
	
	/**
	 * @var string
	 */
	protected $gender;
	
	/**
	 * @var array
	 */
	protected $categories;
	
	public function __construct() { 
		$this->categories = new ArrayObject();
		$this->roles = new RoleCollection([ new RoleObject('user')]); 
	}
	/**
	 * @return the $dob
	 */
	public function getDob() {
		return $this->dob;
	}

	/**
	 * @return the $gender
	 */
	public function getGender() {
		return $this->gender;
	}

	/**
	 * @return the $categories
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * @param \User\Model\Entity\DateTime $dob
	 */
	public function setDob($dob) {
		$this->dob = $dob;
	}

	/**
	 * @param string $gender
	 */
	public function setGender($gender) {
		$this->gender = $gender;
	}

	/**
	 * @param array $categories
	 */
	public function setCategories($categories) {
		$this->categories = $categories;
	}

	/**
	 * @return the $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * @param AddressObject $address
	 */
	public function setAddress($address) {
		$this->address = $address;
	}

	/**
	 * @return the $status
	 */	
	public function getStatus() {
		return $this->status;
	}

	/**
	 * @param string $status
	 */
	public function setStatus($status) {
		$this->status = $status;
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
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $userName
     * @return $this
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param string $recoverPasswordToken
     * @return $this
     */
    public function setRecoverPasswordToken($recoverPasswordToken)
    {
        $this->recoverPasswordToken = $recoverPasswordToken;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRecoverPasswordToken()
    {
        return $this->recoverPasswordToken;
    }

    /**
     * {@inheritdoc}
     */
    public function setPassword($password = null)
    {
        if ($password) {
            $bCrypt = new Bcrypt();
            $bCrypt->setCost(UserInterface::BCRYPT_COST);
            $this->setPasswordCrypt($bCrypt->create($password));
            $this->password = $password;
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getPasswordCrypt()
    {
        return $this->passwordCrypt;
    }

    /**
     * @param $passwordCrypt
     * @return $this
     */
    public function setPasswordCrypt($passwordCrypt)
    {
        $this->passwordCrypt = $passwordCrypt;
        return $this;
    }

    /**
	 * @return RoleCollection
	 */
	public function getRoles() {
		return $this->roles;
	}

	/**
	 * @param RoleCollection $roles
	 */
	public function setRoles($roles) {
		$this->roles = $roles;
	}

	public function hasRole(RoleInterface $entry){
		return $this->roles->has($entry);
	}
	
	public function addRole(RoleInterface $entry){
		return $this->roles->add($entry);
	}	
	
	public function removeRole(RoleInterface $entry){
		return $this->roles->remove($entry);
	}	
	
    /**
     * @return string|null
     */
    /*public function getRoleId()
    {
        if (!$this->roles) {
            $this->addRole(new RoleObject(UserInterface::ROLE_USER));
        }
        //return $this->roles->first();
    }*/

	public function getResourceId() {
	     return 'User';
	}    
	
    /**
     * @param string $registrationToken
     * @return $this
     */
    public function setRegistrationToken($registrationToken)
    {
        $this->registrationToken = $registrationToken;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRegistrationToken()
    {
        return $this->registrationToken;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @param string $credential
     * @return boolean
     */
    public function validateCredential($credential)
    {
        $bCrypt = new Bcrypt();
        $bCrypt->setCost(UserInterface::BCRYPT_COST);
        return $bCrypt->verify($credential, $this->passwordCrypt);
    }
    
	/**
	 * @return ResultSetInterface
	 */    
    public function findItems()
    {
    	return $this->getModel()->findItemsByUser($this->getId());
    }
    
}
