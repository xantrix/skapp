<?php
namespace Application\Model\Entity;

interface ItemInterface 
{
	/**
	 * @return the $name
	 */
	public function getName();

	/**
	 * @param string $name
	 */
	public function setName($name);
	
}

