<?php
namespace User\Form\FieldSet;
use Zend\Form\Fieldset;
use Zend\Form\Element;
use User\Model\Object\Role\RoleObject;

class RoleFieldSet extends Fieldset 
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
        $elementText = new Element\Text('roleId');

        $this->add($elementText);
        return $this;
    }    
    
}

