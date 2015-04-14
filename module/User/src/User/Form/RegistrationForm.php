<?php
namespace User\Form;

use User\Form\FieldSet\UserFieldSet;
//use User\Form\Traits\UserNotRequiredInputTrait;
use User\Model\Validator\Equal;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Validator\Identical;

class RegistrationForm extends Form implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    const NAME = 'registration-form';

    const INPUT_NAME_PASSWORD_RE = 'passwordRe';
    const INPUT_NAME_PRIVACY     = 'privacy';
    const INPUT_PRIVACY_ACCEPT     = 'yes';
    const INPUT_PRIVACY_NOT_ACCEPT = 'no';

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
        $this->addInputPrivacy();
        
        //Set ValidationGroup
        $this->initValidationGroup();
    }

    public function prepare()
    {
    	//Marshalls the input filter (defaults)
    	$form = parent::prepare();
        // Set InputFilter
        $this->initInputFilter(); 
        return $form;   	
    }
    
    /**
     * @return self
     */
    public function addInputPrivacy()
    {
        $element = new Element\Checkbox(self::INPUT_NAME_PRIVACY);
        $element->setCheckedValue(self::INPUT_PRIVACY_ACCEPT)
            ->setUncheckedValue(self::INPUT_PRIVACY_NOT_ACCEPT)
            ->setChecked(true);

        $this->add($element);

        return $this;
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
                $input->setRequired(true);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_EMAIL)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_EMAIL);
                $input->setRequired(true);
                //add identity exists (email) validator: NoIdentityExistsFactory-> new NoIdentityExists, setCriteria,setModel, findIdentity
                $noIdentityValidator = $this->getServiceLocator()->getServiceLocator()->get('ValidatorManager')->get('User\Model\Validator\NoIdentityExists');
                $input->getValidatorChain()->attach($noIdentityValidator);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_PASSWORD)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_PASSWORD);
                $input->setRequired(true);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_PASSWORD_RE)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_PASSWORD_RE);
                $input->setRequired(true);
                //add retype password validator
                $input->getValidatorChain()->attach(new Identical(['token' => UserFieldSet::INPUT_NAME_PASSWORD]));
            }
        }
        // Privacy flag validation
        if ($inputFilter->has(self::INPUT_NAME_PRIVACY)) {
            $input = $inputFilter->get(self::INPUT_NAME_PRIVACY);

            /*$input->setAllowEmpty(false);
            $validator = $this->getServiceLocator()->getServiceLocator()->get('ValidatorManager')->get('equal'); @TODO missing validator
            $validator->setEqualValue(self::INPUT_PRIVACY_ACCEPT);
            $validator->setMessages(
                [
                    Equal::NOT_EQUAL => 'You must accept terms of use, legal notes and privacy policy to continue'
                ]
            );
            $input->getValidatorChain()->attach($validator, true);*/
        }
    }
    
    /**
     * Set the validation group for this form
     */
    protected function initValidationGroup()
    {
    	$this->setValidationGroup([
    			'user-fieldset' => [
					'email',
    				'password',
    				'password_re'
    			]
    	]);
    }
    
}
