<?php
namespace User\Form;

use Zend\Filter\StringToLower;
use Zend\Form\Element;
use Zend\Form\Exception;
use Zend\Form\Form;
use Zend\InputFilter\Input;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\Validator\AbstractValidator;
use Zend\Validator\EmailAddress;

/**
 * Class LoginForm
 */
class LoginForm extends Form implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    const NAME = 'login';

    const INPUT_NAME_PASSWORD = 'password';
    const INPUT_NAME_EMAIL = 'email';

    /**
     * Ctor
     */
    public function __construct()
    {
        parent::__construct(self::NAME);
        $this->setAttribute('method', 'POST');
        $this->addEmail()
            ->addPassword();
    }

    /**
     * Init
     */
    public function init()
    {
        /* @var $validator AbstractValidator */
        $validator = $this->get(self::INPUT_NAME_EMAIL)->getEmailValidator();
        $validator->setTranslator($this->getServiceLocator()->getServiceLocator()->get('MvcTranslator'));
        $inputFilter = $this->getInputFilter();
        $inputFilter->add($this->getPasswordInput());
        $inputFilter->add($this->getEmailInput());
    }

    /**
     * @return $this
     */
    protected function addPassword()
    {
        $element = new Element\Password(self::INPUT_NAME_PASSWORD);
        $this->add($element);
        return $this;
    }

    /**
     * @return $this
     */
    protected function addEmail()
    {
        $element = new Element\Email(self::INPUT_NAME_EMAIL);
        $element->setEmailValidator(new EmailAddress);
        $this->add($element);
        return $this;
    }

    /**
     * @return Input
     */
    public function getPasswordInput()
    {
        $input = new Input(self::INPUT_NAME_PASSWORD);
        $input->setRequired(true);
        return $input;
    }

    /**
     * @return Input
     */
    public function getEmailInput()
    {
        $input = new Input(self::INPUT_NAME_EMAIL);
        $input->setRequired(true);

        $input->getFilterChain()->attach(new StringToLower(['encoding' => 'UTF-8']));

        return $input;
    }
}
