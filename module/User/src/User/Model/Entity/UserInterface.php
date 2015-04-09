<?php
namespace User\Model\Entity;

use Matryoshka\Model\Object\IdentityAwareInterface;
use Zend\Permissions\Acl\Role\RoleInterface;
use Application\Model\DateAwareInterface;

/**
 * Base user identity interface.
 *
 * Includes the minimum set of data needed to uniquely identify the user.
 * All users who can log in to the system must implement this interface.
 *
 */
interface UserInterface extends IdentityAwareInterface, /*RoleInterface,*/ DateAwareInterface
{

    const ROLE_USER = 'user';
	const GENDER_MAN = 'male';
	const GENDER_WOMAN = 'female';
    
    const BCRYPT_COST = 10;

    /**
     * @param string $email
     * @return self
     */
    public function setEmail($email);

    /**
     * @return string
    */
    public function getEmail();

    /**
     * @param $userName
     * @return self
     */
    public function setUserName($userName);

    /**
     * @return string
    */
    public function getUserName();

    /**
     * @param string $password
     * @return self
    */
    public function setPassword($password = null);

    /**
     * @return string
    */
    public function getPassword();

    /**
     * @param string $recoverPasswordToken
     * @return self
    */
    public function setRecoverPasswordToken($recoverPasswordToken);

    /**
     * @return string
    */
    public function getRecoverPasswordToken();

    /**
     * @param string $registrationToken
     * @return self
    */
    public function setRegistrationToken($registrationToken);

    /**
     * @return string
    */
    public function getRegistrationToken();

    /**
     * @param string $role
     * @return self
    */
    //public function setRoleId($role);

    /**
     * @return string
    */
    //public function getRoleId();

    /**
     * @param int $status
     * @return self
    */
    public function setStatus($status);

    /**
     * @return int
    */
    public function getStatus();

    /**
     * @return string
     */
    public function getLanguage();

    /**
     * @param string $language
     * @return $this
    */
    public function setLanguage($language);


}