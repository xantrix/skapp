<?php
namespace User\Model;

use Application\Model\AbstractEntity;
use Zend\Crypt\Password\Bcrypt;
use Application\Model\DateAwareTrait;
use AuthModule\Identity\ObjectInterface as AuthObjectInterface;

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
     * @var string
     */
    protected $roleId;

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
     * @param string $role
     * @return $this
     */
    public function setRoleId($role)
    {
        $this->roleId = $role;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRoleId()
    {
        if (!$this->roleId) {
            $this->roleId = UserInterface::ROLE_USER;
        }
        return $this->roleId;
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
}
