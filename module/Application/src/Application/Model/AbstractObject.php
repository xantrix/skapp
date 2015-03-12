<?php
namespace Application\Model;

use Matryoshka\Model\Object\AbstractObject as BaseObject;
use Matryoshka\Model\Hydrator\ClassMethods;

abstract class AbstractObject extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->hydrator = new ClassMethods(true);
        }
        return $this->hydrator;
    }
}