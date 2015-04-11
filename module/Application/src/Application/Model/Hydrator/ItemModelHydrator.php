<?php
namespace Application\Model\Hydrator;

use Matryoshka\Model\Wrapper\Mongo\Hydrator\ClassMethods;
use Matryoshka\Model\Wrapper\Mongo\Hydrator\Strategy\MongoDateStrategy;

/**
 * Class ItemModelHydrator
 *
 * This hydrator is used by the model to
 * hydrate data from the DB to the entity object (reading) and
 * to extract data from the entity in order to be saved into the DB (writing)
 */
class ItemModelHydrator extends ClassMethods
{
    /**
     *
     */
    public function __construct()
    {
        parent::__construct(true);

        // Convert DateTime to MongoDate and vice versa
        $this->addStrategy('date_created', new MongoDateStrategy());
        $this->addStrategy('date_modified', new MongoDateStrategy());
        
    }	
}

