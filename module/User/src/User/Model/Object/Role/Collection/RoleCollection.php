<?php
namespace User\Model\Object\Role\Collection;

use Zend\Stdlib\ArrayObject;
use User\Model\Object\Role\RoleInterface;

class RoleCollection extends ArrayObject implements RoleCollectionInterface {
	
    public function offsetSet($key, $value)
    {
        if (!$value instanceof RoleInterface) {
            throw new \InvalidArgumentException(sprintf(
                'Value added in this collection must be instance of RoleInterface, "%s" given.',
                is_object($value) ? get_class($value) : gettype($value)
            ));
        }

        return parent::offsetSet($key, $value);
    }

    /**
     * @param RoleInterface $entry
     */
    public function add(RoleInterface $entry)
    {
        $this->append($entry);
    }

    /**
     * @param RoleInterface $entry
     */
    public function has(RoleInterface $entry)
    {
        // FIXME: check
        foreach ($this as $key => $value) {
            if ($value == $entry) {
                return true;
            }
        }
        return false;
    }    
    
    /**
     * @param RoleInterface $entry
     */
    public function remove(RoleInterface $entry)
    {
        // FIXME: check
        foreach ($this as $key => $value) {
            if ($value == $entry) {
                $this->offsetUnset($key);
                break;
            }
        }
    }

    public function toArray()
    {
    	$result = [];
    	foreach ($this as $key => $value) {
    		$result[] = $value->toArray();
    	}
    	return $result;
    }
    
}

?>