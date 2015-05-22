<?php
namespace User\Form;

use User\Form\FieldSet\UserFieldSet;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

class SearchForm extends Form implements ServiceLocatorAwareInterface
{
	use ServiceLocatorAwareTrait;
	
	const NAME = 'search-form';
	
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
        
        //Set ValidationGroup
        $this->initValidationGroup();
    }

    public function getInputFilter()
    {
    	if(!$this->filter){
    		$filter = parent::getInputFilter();
    		$this->initInputFilter();
    		return $filter;
    	}else{
    		return parent::getInputFilter();
    	}
    }    
    
    /**
     * Set the inputFilter for this form
     */
    protected function initInputFilter()
    {
        $inputFilter = $this->getInputFilter();
        if ($inputFilter->has(UserFieldSet::NAME)) {
            $inputFilterFieldSet = $inputFilter->get(UserFieldSet::NAME);//get UserFieldSet

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_USERNAME)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_USERNAME);
                $input->setRequired(false);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_EMAIL)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_EMAIL);
                $input->setRequired(false);
                
                //http://stackoverflow.com/questions/16252520/how-to-remove-a-validator-from-a-form-element-form-element-validatorchain-in-z
				// create new validator chain
				$newValidatorChain = new \Zend\Validator\ValidatorChain;
				// loop through all validators of the validator chained currently attached to the element
				foreach ($input->getValidatorChain()->getValidators() as $validator) {
				    // attach validator unless it's instance of ...
				    if (!($validator['instance'] instanceof \Zend\Validator\Regex)) {
				        $newValidatorChain->addValidator($validator['instance'], $validator['breakChainOnFailure']);
    				}
				}
				// replace the old validator chain on the element
				$input->setValidatorChain($newValidatorChain);                
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_GENDER)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_GENDER);
                $input->setRequired(false);
            }
        
            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_LANGUAGE)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_LANGUAGE);
                $input->setRequired(false);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_STATUS)) {
                $statusElement = $this->get(UserFieldSet::NAME)->get(UserFieldSet::INPUT_NAME_STATUS);
				$statusElement->setEmptyOption('-');
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_STATUS);
                $input->setRequired(false);				
            }            
            
        }

    }    
    
    /**
     * Set the validation group for this form
     */
    protected function initValidationGroup()
    {
    	$this->setValidationGroup([
    			'user-fieldset' => [
    				'id',
    				'user_name',
					'email',
    				'first_name',
    				'last_name',
    				'gender',
    				'dob',
    				'roles',
    				'status'
    			]
    	]);
    }    
    
}
