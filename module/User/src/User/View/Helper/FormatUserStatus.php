<?php
namespace User\View\Helper;

use Zend\View\Helper\AbstractHelper;
use User\Model\Entity\UserInterface;

class FormatUserStatus extends AbstractHelper
{
	
    /**
     * Convert an number status in string
     * @param $status number
     * @return string
     */
    public function __invoke($status)
    {
    	switch ($status) {
    		case UserInterface::STATUS_INACTIVE:
    			return UserInterface::STATUS_LABEL_INACTIVE;    		
    		
    		case UserInterface::STATUS_ACTIVE:
    			return UserInterface::STATUS_LABEL_ACTIVE;

    		case UserInterface::STATUS_BLOCKED:
    			return UserInterface::STATUS_LABEL_BLOCKED;    		

    		case UserInterface::STATUS_REMOVED:
    			return UserInterface::STATUS_LABEL_REMOVED;     		
    		
    	}
    }	
}

