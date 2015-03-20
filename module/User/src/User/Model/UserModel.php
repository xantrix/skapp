<?php
namespace User\Model;

use Matryoshka\Model\Model;
use AuthModule\Identity\ModelInterface as AuthModelInterface;
use User\Model\Criteria\UserCollectionCriteria;
use Matryoshka\Model\ObservableModel;

class UserModel extends ObservableModel implements AuthModelInterface
{

    /**
     * {@inheritdoc}
     */
    public function findByIdentity($identity)
    {
        return $this->find((new UserCollectionCriteria())->setEmail($identity));
    }


}