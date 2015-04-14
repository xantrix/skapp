<?php
namespace Application\Model\Criteria;

use Matryoshka\Model\Wrapper\Mongo\Criteria\FindAllCriteria;
use MongoId;

class ItemCollectionCriteria extends FindAllCriteria
{
	
	/**
	 * @param string $userId
	 * @return $this
	 */
	public function setUserId($userId)
	{
        $this->selectionCriteria['user_id'] = new MongoId($userId) ;
        return $this;		
	}
	
}

