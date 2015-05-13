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
                $input->setRequired(true);
                //add identity exists (email) validator: NoIdentityExistsFactory-> new NoIdentityExists, setCriteria,setModel, findIdentity
                /* @var $noIdentityValidator \User\Model\Validator\NoIdentityExists */
                $noIdentityValidator = $this->getServiceLocator()->getServiceLocator()->get('ValidatorManager')->get('User\Model\Validator\NoIdentityExists');
                $noIdentityValidator->setExcludeField('id');
                $input->getValidatorChain()->attach($noIdentityValidator);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_GENDER)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_GENDER);
                $input->setRequired(false);
            }
        
            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_LANGUAGE)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_LANGUAGE);
                $input->setRequired(false);
            }        
            
            /*if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_PASSWORD)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_PASSWORD);
                $input->setRequired(true);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_PASSWORD_RE)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_PASSWORD_RE);
                $input->setRequired(true);
                //add retype password validator
                $input->getValidatorChain()->attach(new Identical(['token' => UserFieldSet::INPUT_NAME_PASSWORD]));
            }*/
            
            /*if($inputFilterFieldSet->has('roles')){
            	$roles = $inputFilterFieldSet->get('roles');//inputFilter 
            	$roleFieldset = $this->get('user-fieldset')->get('roles')->getTargetElement();//collection->roleFieldset
            	$collectionInputFilters = $roles->getInputs();//inputFilter (#elementsInCollection)
            	foreach ($collectionInputFilters as $roleInputFilter) {
            		//$roleInputs = $roleInputFilter->getInputs();
            		//foreach ($roleInputs as $roleInput) {
            			$roleInput->setRequired(true);
            		//}
            		$roleInput = $roleInputFilter->get('role_id');
            		$roleInput->setRequired(true);
            	}
            }*/
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
    				//'roles'
    			]
    	]);
    }    
    
    public function addRolesValidation()
    {
    	$validationGroup = $this->getValidationGroup();
    	if($validationGroup){
    		$validationGroup['user-fieldset'][] = 'roles';
    		$this->setValidationGroup($validationGroup);
    	}
    }
    
}
