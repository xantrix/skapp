<?php
namespace Application\Model\Object\Category;

trait CategoryTrait 
{
     /**
      * @var string
      */
     protected $name;

	public function __construct($name = null){
		$this->name = $name;
	}
	     
     /**
      * @param string $name
      * @return Category
      */
     public function setName($name)
     {
         $this->name = $name;
         return $this;
     }

     /**
      * @return string
      */
     public function getName()
     {
         return $this->name;
     }	
}

