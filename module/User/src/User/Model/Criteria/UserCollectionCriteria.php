<?php
namespace User\Model\Criteria;

use Matryoshka\Model\Wrapper\Mongo\Criteria\FindAllCriteria;
use DateTime;
use MongoDate;
use MongoId;
use MongoRegex;

class UserCollectionCriteria extends FindAllCriteria
{
    
    public function setExcludeId($id)
    {
        $this->selectionCriteria['_id']['$ne'] = new MongoId($id);
        return $this; 
    }
	
    public function getExcludeId()
    {
    	return isset($this->selectionCriteria['_id']['$ne']) ? $this->selectionCriteria['_id']['$ne'] : null;
    }
    
	public function getEmail()
    {
        return isset($this->selectionCriteria['email']) ? $this->selectionCriteria['email'] : null;
    }    
	
    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email, $partialMatch = false)
    {
        if(!$partialMatch)
    		$this->selectionCriteria['email'] = (string) $email;
        else
        	$this->selectionCriteria['email'] = new MongoRegex("/$email/i");
        return $this;
    }
    
    public function getUserName()
    {
        return isset($this->selectionCriteria['user_name']) ?
            $this->selectionCriteria['user_name'] :
            null;
    }

    /**
     * @param $userName
     * @return $this
     */
    public function setUserName($userName)
    {
        $this->selectionCriteria['user_name'] = (string)$userName;
        return $this;
    }    
    
    public function getRegistrationToken()
    {
        return isset($this->selectionCriteria['registration_token']) ?
            $this->selectionCriteria['registration_token'] :
            null;
    }

    /**
     * @param $registrationToken
     * @return $this
     */
    public function setRegistrationToken($registrationToken)
    {
        $this->selectionCriteria['registration_token'] = (string)$registrationToken;
        return $this;
    }

    public function getRecoverPasswordToken()
    {
        return isset($this->selectionCriteria['recover_password_token']) ?
            $this->selectionCriteria['recover_password_token'] :
            null;
    }

    /**
     * @param $recoverPasswordToken
     * @return $this
     */
    public function setRecoverPasswordToken($recoverPasswordToken)
    {
        $this->selectionCriteria['recover_password_token'] = (string)$recoverPasswordToken;
        return $this;
    }

    /**
     * @param $status
     * @return $this
     */    
    public function setStatus($status)
    {
        $this->selectionCriteria['status'] = (int) $status;
        return $this;
    }

    /**
     * @param $from
     * @return $this
     */     
    public function setCreatedDateFrom($from)
    {
        $dateTime = DateTime::createFromFormat(DATE_ISO8601, $from);
        if ($dateTime) {
            if (isset($this->selectionCriteria['date_created']) && !is_array($this->selectionCriteria['date_created'])) {
                $this->selectionCriteria['date_created'] = [];
            }
            $this->selectionCriteria['date_created']['$gt'] = new MongoDate($dateTime->format('U'));
        }
        return $this;
    }

    /**
     * @param $to
     * @return $this
     */     
    public function setCreatedDateTo($to)
    {
        $dateTime = DateTime::createFromFormat(DATE_ISO8601, $to);
        if ($dateTime) {
            if (isset($this->selectionCriteria['date_created']) && !is_array($this->selectionCriteria['date_created'])) {
                $this->selectionCriteria['date_created'] = [];
            }
            $this->selectionCriteria['date_created']['$lt'] = new MongoDate($dateTime->format('U'));
        }
        return $this;
    }
    
}