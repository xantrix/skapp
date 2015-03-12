<?php
namespace Application\Model;

use DateTime;

/**
 * Trait DateAwareTrait
 */
trait DateAwareTrait
{
    /**
     * @var DateTime
     */
    public $dateCreated;

    /**
     * @var DateTime
     */
    public $dateModified;

    /**
     * @param DateTime $dateCreated
     * @return self
     */
    public function setDateCreated(DateTime $dateCreated = null)
    {
        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateModified
     * @return self
     */
    public function setDateModified(\DateTime $dateModified = null)
    {
        $this->dateModified = $dateModified;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateModified()
    {
        return $this->dateModified;
    }
}
