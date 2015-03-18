<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;

/**
 * @method \AuthModule\Controller\Plugin\InteractiveAuth interactiveAuth()
 */
class UserController extends AbstractActionController
{

    /**
     * @var string
     */
    protected $defaultRedirectRouteName = 'home';

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
        $prg = $this->prg();
        if ($prg instanceof Response) {
            return $prg;
        }

        // post login redirect url
        $next = $this->params()->fromQuery('next', $this->url()->fromRoute(
            $this->defaultRedirectRouteName
        ));

        if ($this->identity()) {
            //User logged in already.
            return $this->redirect()->toUrl($next);
        }

        $formLogin = $this->serviceLocator->get('FormElementManager')->get('User\Form\LoginForm');

        if (is_array($prg)) {
            $formLogin->setData($prg);
            if ($formLogin->isValid()) {
                $result = $this->interactiveAuth()->login(
                    $formLogin->get('email')->getValue(),
                    $formLogin->get('password')->getValue()
                );

                if ($result) {
                    //OK! User logged in successfully
                    return $this->redirect()->toUrl($next);
                }
                // else, authentication error
                $errors = [];
                foreach ($result->getMessages() as $k => $v) {
                    $errors[$k] = $this->getServiceLocator()->get('translator')->translate($v);
                }

                // FIXME: find a better way to handle errors
                $formLogin->setMessages(array('email' => $errors));
            }
        }

        return new ViewModel([
           'formLogin' => $formLogin
        ]);

    }

    public function registrationAction()
    {
    	$registrationForm = $this->serviceLocator->get('FormElementManager')->get('User\Form\RegistrationForm');
    	
    	return new ViewModel([
           'registrationForm' => $registrationForm
    	]);
    }
    
    public function recoverPasswordAction()
    {
    	return new ViewModel();
    }

    //authenticated actions
    public function logoutAction()
    {
        if (!$this->identity()) {
            return $this->redirect()->toRoute($this->defaultRedirectRouteName);
        }

        $this->interactiveAuth()->logout();
        return $this->redirect()->toRoute($this->defaultRedirectRouteName);
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

