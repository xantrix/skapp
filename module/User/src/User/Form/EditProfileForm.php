<?php
namespace User\Form;

use User\Form\FieldSet\UserFieldSet;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class EditProfileForm extends Form implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;
	
	const NAME = 'edit-profile-form';
	
    /**
     * Construct
     */
    public function __construct()
    {
        // Config
        parent::__construct(self::NAME);
        $this->setAttribute('method', 'POST');
    }

    /**
     * Init fieldsets, elements, inputFilter and validationGroup
     */
    public function init()
    {
        // Add Fieldset
        $this->add(
            [
                'name' => UserFieldSet::NAME,
                'type' => 'User\Form\FieldSet\UserFieldSet'
            ]
        );

        // Add element
        //$this->addInputPrivacy();
        
        //Set ValidationGroup
        //$this->initValidationGroup();
    }
        
}
