<?php
namespace User\Form\FieldSet;
use Zend\Form\Fieldset;
use Zend\Form\Element;
use User\Model\Object\Role\RoleObject;
use User\Model\Object\Role\RoleInterface;
use Zend\InputFilter\InputFilterProviderInterface;

class RoleFieldSet extends Fieldset implements InputFilterProviderInterface 
{
	const NAME = 'role-fieldset';
	const INPUT_NAME_ROLEID = 'role_id';
	
    public function __construct()
    {
        parent::__construct(self::NAME);

        $this->setObject(new RoleObject());
        $this->addRoleId();
    }	
	
    public function addRoleId()
    {
//         $elementText = new Element\Text('role_id');
// 		$elementText->setAttribute('placeholder', 'roleid');
		
        $element = new Element\Select(self::INPUT_NAME_ROLEID);
        //$element->setEmptyOption('-');
        $element->setValueOptions(
            [
                RoleInterface::ROLE_USER => 'User',
        		RoleInterface::ROLE_B2B => 'B2b',
        		RoleInterface::ROLE_OTHER => 'Other',
        		RoleInterface::ROLE_ADMIN => 'Admin',
            ]
        );
        		
        $this->add($element);
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

