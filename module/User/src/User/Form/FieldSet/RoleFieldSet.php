<?php
namespace User\Form\FieldSet;
use Zend\Form\Fieldset;
use Zend\Form\Element;
use User\Model\Object\Role\RoleObject;
use Zend\InputFilter\InputFilterProviderInterface;

class RoleFieldSet extends Fieldset implements InputFilterProviderInterface 
{
	const NAME = 'role-fieldset';
	
    public function __construct()
    {
        parent::__construct(self::NAME);

        $this->setObject(new RoleObject());
        $this->addRoleId();
    }	
	
    public function addRoleId()
    {
        $elementText = new Element\Text('role_id');
		$elementText->setAttribute('placeholder', 'roleid');
        $this->add($elementText);
        return $this;
    }    
    
     /**
      * @return array
      */
     public function getInputFilterSpecification()
     {
         return array(
             'role_id' => array(
                 'required' => true,
             ),
         );
     }    
    
}

