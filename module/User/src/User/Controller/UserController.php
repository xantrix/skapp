<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{

	/**
	 * @var \User\Model\UserModel
	 */
	protected $userModel;
	
	/**
	 * @var \User\Model\UserEntity
	 */
	protected $user;
	
    public function indexAction()
    {
    	$this->userModel = $this->model()->get('User\Model\UserModel');
    	
    	//create
    	$this->user = $this->userModel->create();
    	$this->user->setEmail('test@test.com');
    	//$this->user->save();
    	//$writableCriteria = \Matryoshka\Model\Criteria\WritableCriteriaInterface;
    	//$this->userModel->save($writableCriteria, $dataOrObject);
    	
    	//find
		$users = $this->userModel->find(
		    new \Matryoshka\Model\Criteria\CallbackCriteria(
		        function ($model) {
		            $dataGateway = $model->getDataGateway();
		            return $dataGateway->find()->limit(100);
		        }
		    )
		);
        return new ViewModel([
			'users' => $users
        ]);
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

