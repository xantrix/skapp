<?php
namespace User\Model\Hydrator;

use Matryoshka\Model\Hydrator\ClassMethods;
use Matryoshka\Model\Hydrator\Strategy\DateTimeStrategy;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;

/**
 * Class UserEntityHydrator
 *
 * This hydrator is used to extract data from entity to other components (form, view etc..)
 *
 */
class UserEntityHydrator extends ClassMethods
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
        $this->addStrategy('dob', new DateTimeStrategy('d-m-Y'));

        // Remove hidden field from output
        $this->filterComposite->addFilter('passwordCrypt', new MethodMatchFilter('getPasswordCrypt'), FilterComposite::CONDITION_AND);
        $this->filterComposite->addFilter('recoverPasswordToken', new MethodMatchFilter('getRecoverPasswordToken'), FilterComposite::CONDITION_AND);
        $this->filterComposite->addFilter('registrationToken', new MethodMatchFilter('getRegistrationToken'), FilterComposite::CONDITION_AND);
    }
}
