<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    //unauthenticated actions
    public function loginAction()
    {
    	return new ViewModel();
    }    
    
    public function resetPasswordAction()
    {
    	return new ViewModel();
    }    
    
    //athenticated actions
    public function logoutAction()
    {
    	return new ViewModel();
    }    
    
    public function profileAction()
    {
    	return new ViewModel();
    }    

    public function profileEditAction()
    {
    	return new ViewModel();
    }    
    
    public function adminOnlyAction()
    {
    	return new ViewModel();
    }    
    
}

