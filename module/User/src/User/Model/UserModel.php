<?php
namespace User\Model;

use Matryoshka\Model\Model;
use AuthModule\Identity\ModelInterface as AuthModelInterface;
use User\Model\Criteria\UserCollectionCriteria;

class UserModel extends Model implements AuthModelInterface
{

    /**
     * {@inheritdoc}
     */
    public function findByIdentity($identity)
    {
        return $this->find((new UserCollectionCriteria())->setEmail($identity));
    }


}