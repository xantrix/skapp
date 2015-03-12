<?php
namespace Application\Model;

use DateTime;
use Matryoshka\Model\Object\ActiveRecord\AbstractActiveRecord;

/**
 * Class AbstractEntity
 */
abstract class AbstractEntity extends AbstractActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function save()
    {
        //automatize date aware objects
        if ($this instanceof DateAwareInterface) {
            if ($this->getId() == null || $this->getDateCreated() == null) {
                $this->setDateCreated(new DateTime('now'));
            } else {
                $this->setDateModified(new DateTime('now'));
            }
        }

        return parent::save();
    }
}