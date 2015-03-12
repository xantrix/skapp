<?php
namespace Application\Model;

use DateTime;

/**
 * Interface DateAwareInterface
 */
interface DateAwareInterface
{
    /**
     * @param DateTime $dateCreated
     * @return $this
     */
    public function setDateCreated(DateTime $dateCreated = null);

    /**
     * @return DateTime
     */
    public function getDateCreated();

    /**
     * @param DateTime $dateModified
     * @return mixed
     */
    public function setDateModified(DateTime $dateModified = null);

    /**
     * @return DateTime
     */
    public function getDateModified();
}
