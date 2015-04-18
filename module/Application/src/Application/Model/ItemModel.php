<?php
namespace Application\Model;

use Matryoshka\Model\ObservableModel;
use Application\Model\Criteria\ItemCollectionCriteria;

class ItemModel extends ObservableModel
{
	
	/**
	 * @param string $userId
	 * @return ResultSetInterface
	 */
	public function findItemsByUser($userId)
	{
		return $this->find((new ItemCollectionCriteria())->setUserId($userId));
	}
}
