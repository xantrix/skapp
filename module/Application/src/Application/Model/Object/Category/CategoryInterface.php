<?php
namespace Application\Model\Object\Category;

interface CategoryInterface 
{
     /**
      * @param string $name
      * @return Category
      */
     public function setName($name);

     /**
      * @return string
      */
     public function getName();
}

