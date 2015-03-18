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
    //use UserNotRequiredInputTrait; @TODO missing file

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
     * Init
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

        //$this->initUserFiledSetInputNotRequire($this->getInputFilter());@TODO missing method

        // Set InputFilter
        $this->initInputFilter();
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
     *
     */
    protected function initInputFilter()
    {
        $inputFilter = $this->getInputFilter();
        if ($inputFilter->has(UserFieldSet::NAME)) {
            $inputFilterFieldSet = $inputFilter->get(UserFieldSet::NAME);

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_USERNAME)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_USERNAME);
                $input->setRequired(true);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_EMAIL)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_EMAIL);
                $input->setRequired(true);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_PASSWORD)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_PASSWORD);
                $input->setRequired(true);
            }

            if ($inputFilterFieldSet->has(UserFieldSet::INPUT_NAME_PASSWORD_RE)) {
                $input = $inputFilterFieldSet->get(UserFieldSet::INPUT_NAME_PASSWORD_RE);
                $input->setRequired(true);
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
}
