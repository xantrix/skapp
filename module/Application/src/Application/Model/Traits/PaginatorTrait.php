<?php
namespace Application\Model\Traits;

use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Paginator\Adapter\Iterator;

/**
 * Trait Paginator
 */
trait PaginatorTrait
{

	public function getPaginatorFromAdapter($adapter)
	{
    	$paginator = new Paginator($adapter);
    	return $paginator;		
	}
	
    public function getPaginatorFromArray($array)
    {
    	$adapter = new ArrayAdapter($array);
    	$paginator = new Paginator($adapter);
    	return $paginator;
    }

    public function getPaginatorFromIterator($iterator)
    {
    	$adapter = new Iterator($iterator);
    	$paginator = new Paginator($adapter);
    	return $paginator;
    }    
    
}