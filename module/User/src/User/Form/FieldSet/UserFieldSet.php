<?php
namespace User\Form\FieldSet;

use Application\Form\FieldSet\AddressFieldSet;
use Application\Form\FieldSet\CategoryFieldSet;
use User\Model\Entity\UserEntity;
use User\Model\Entity\UserInterface;
use Zend\Form\Element;
use Zend\Form\Fieldset;

/**
 * Class UserFieldSet
 * @package User\Form\FieldSet
 */
class UserFieldSet extends Fieldset
{
    const NAME = 'user-fieldset';

    const INPUT_NAME_EMAIL         = 'email';
    const INPUT_NAME_USERNAME      = 'user_name';
    const INPUT_NAME_PASSWORD      = 'password';
    const INPUT_NAME_PASSWORD_RE   = 'password_re';
    const INPUT_NAME_FIRST_NAME    = 'first_name';
    const INPUT_NAME_LAST_NAME     = 'last_name';
    const INPUT_NAME_PHONE_NUMBER  = 'phone_number';
    const INPUT_NAME_GENDER        = 'gender';
    const INPUT_NAME_DOB        = 'dob';
    const INPUT_NAME_CATEGORIES   = 'categories';
    const INPUT_NAME_LANGUAGE      = 'language';
    const INPUT_NAME_MOBILE_PHONE_NUMBER  = 'mobile_phone_number';

    /**
     * Construct
     */
    public function __construct()
    {
        // Config
        parent::__construct(self::NAME);
        //$this->setObject(new UserEntity());
        $this->setUseAsBaseFieldset(true);
        // Add element
        $this
            ->addInputGender()
            ->addInputDob()
            ->addInputCategories() //CategoryFieldSet
            ->addInputFirsName()
            ->addInputLastName()
            ->addInputMobilePhoneNumber()
            ->addInputPhoneNumber()
            ->addInputPassword()
            ->addInputPasswordRe()
            ->addInputUserName()
            ->addInputEmail()
            ->addInputAddress() //AddressFieldSet
            ->addInputRoles() //RoleFieldset
            ->addInputLanguage()
        ;
    }

    /**
     * @return $this
     */
    public function addInputEmail()
    {
        $element = new Element\Email(self::INPUT_NAME_EMAIL);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputUserName()
    {
        $element = new Element\Text(self::INPUT_NAME_USERNAME);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputPassword()
    {
        $element = new Element\Password(self::INPUT_NAME_PASSWORD);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputPasswordRe()
    {
        $element = new Element\Password(self::INPUT_NAME_PASSWORD_RE);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputFirsName()
    {
        $element = new Element\Text(self::INPUT_NAME_FIRST_NAME);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputLastName()
    {
        $element = new Element\Text(self::INPUT_NAME_LAST_NAME);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputPhoneNumber()
    {
        $element = new Element\Text(self::INPUT_NAME_PHONE_NUMBER);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputMobilePhoneNumber()
    {
        $element = new Element\Text(self::INPUT_NAME_MOBILE_PHONE_NUMBER);
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputAddress()
    {
        $element =  new AddressFieldSet();
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputRoles()
    {
        $collectionRole = new Element\Collection('roles');
        $collectionRole->setCount(2)
            ->setAllowAdd(true)
            ->setShouldCreateTemplate(true)
            ->setTargetElement(new RoleFieldSet());

        $this->add($collectionRole);
        return $this;
    }    
    
    /**
     * @return $this
     */
    public function addInputGender()
    {
        $element = new Element\Select(self::INPUT_NAME_GENDER);
        $element->setEmptyOption('-');
        $element->setValueOptions(
            [
                UserInterface::GENDER_MAN => 'Mr',
                UserInterface::GENDER_WOMAN => 'Mrs',
            ]
        );
        $this->add($element);

        return $this;
    }

    /**
     * @return $this
     */
    public function addInputDob()
    {
        $element = new Element\Text(self::INPUT_NAME_DOB);
        $this->add($element);

        return $this;
    }    
    
    /**
     * @return $this
     */
    public function addInputCategories()
    {
        $this->add(array(
            'type' => 'Zend\Form\Element\Collection',
            'name' => 'categories',
            'options' => array(
                'label' => 'Please choose cat for this',
                'count' => 1,
                'should_create_template' => true,
                'allow_add' => true,
                'target_element' => array(
                    'type' => 'Application\Form\FieldSet\CategoryFieldSet',
                ),
            ),
        ));        
        return $this;
    }     
    
    public function addInputLanguage()
    {
        $element = new Element\Select(self::INPUT_NAME_LANGUAGE);
        $element->setEmptyOption('-');
        $this->add($element);

        return $this;
    }
}
