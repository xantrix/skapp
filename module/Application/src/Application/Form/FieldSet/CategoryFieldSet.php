<?php
namespace Application\Form\FieldSet;

use Application\Model\Object\Category\CategoryObject;
use Zend\Form\Element;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;

class CategoryFieldSet extends Fieldset implements InputFilterProviderInterface
{
	const NAME = 'category-fieldset';
	
	const INPUT_NAME_NAME     = 'name';
	
    public function init(array $config = [])
    {
        parent::__construct(self::NAME);
        $this->setObject(new CategoryObject());

        $this->addName();
    }
    
    /**
     * @return $this
     */
    protected function addName()
    {
        $elementText = new Element\Text(self::INPUT_NAME_NAME);
        $this->add($elementText);
        return $this;
    }

     /**
      * @return array
      */
     public function getInputFilterSpecification()
     {
         return array(
             'name' => array(
                 'required' => false,
             ),
         );
     }    
    
}
