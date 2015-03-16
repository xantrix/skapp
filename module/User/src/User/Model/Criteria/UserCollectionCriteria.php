<?php
namespace User\Model\Criteria;

use Matryoshka\Model\Wrapper\Mongo\Criteria\FindAllCriteria;

class UserCollectionCriteria extends FindAllCriteria
{
    /**
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->selectionCriteria['email'] = (string) $email;
        return $this;
    }
}