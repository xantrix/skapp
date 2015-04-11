<?php
namespace Application\Model\Hydrator;

use Matryoshka\Model\Hydrator\ClassMethods;
use Matryoshka\Model\Hydrator\Strategy\DateTimeStrategy;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;

/**
 * Class ItemEntityHydrator
 *
 * This hydrator is used to extract data from entity to other components (form, view etc..)
 *
 */
class ItemEntityHydrator extends ClassMethods
{
       /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct(true);

        // Convert DateTime to a formated string and viceversa
        $this->addStrategy('date_created', new DateTimeStrategy());
        $this->addStrategy('date_modified', new DateTimeStrategy());

        // Remove hidden field from output
        //$this->filterComposite->addFilter('some', new MethodMatchFilter('getSome'), FilterComposite::CONDITION_AND);
    }	
}

