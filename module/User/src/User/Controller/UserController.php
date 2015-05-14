<?php
namespace User\Controller;

use Application\Utility\Message;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Http\Response;
use User\Model\Entity\UserEntity;
use Zend\Mvc\MvcEvent;
use BjyAuthorize\Exception\UnAuthorizedException;

/**
 * @method \AuthModule\Controller\Plugin\InteractiveAuth interactiveAuth()
 * @method \Application\Controller\Plugin\MongoIdShort mongoIdShort()
 */
class UserController extends AbstractActionController
{
    /**
     * @var string
     */
    protected $defaultRedirectRouteName = 'home';
    protected $profileRouteName = 'user/profile';

	/**
	 * @var \User\Model\UserModel
	 */
	protected $userModel;

	public function onDispatch(MvcEvent $e)
	{
		$this->userModel = $this->model()->get('User\Model\UserModel');
		return parent::onDispatch($e);
	}
	
	public function indexAction()
	{
		return true;
	}

    //unauthenticated actions
    public function loginAction()
    {
        $prg = $this->prg();
        if ($prg instanceof Response) {
            return $prg;
        }

        if ($this->identity()) {
	        // post login redirect url
	        /* @var $user UserEntity  */
	        $user = $this->interactiveAuth()->getAuthenticationService()->getIdentityObject();
	        $next = $this->params()->fromQuery('next', $this->url()->fromRoute(
	            $this->profileRouteName,['id' =>$this->id2Short($user->getId())]
	        ));         	
            //User logged in already.
            return $this->redirect()->toUrl($next);
        }

        $loginForm = $this->serviceLocator->get('FormElementManager')->get('User\Form\LoginForm');

        if (is_array($prg)) {
            $loginForm->setData($prg);
            if ($loginForm->isValid()) {
                //ModelAdapter::authenticate -> modelObject::findByIdentity -> $identityObject::validateCredential
            	$result = $this->interactiveAuth()->login(
                    $loginForm->get('email')->getValue(),
                    $loginForm->get('password')->getValue()
                );

                if ($result->isValid()) {
			        // post login redirect url
	        		/* @var $user UserEntity  */
	        		$user = $this->interactiveAuth()->getAuthenticationService()->getIdentityObject();			        
			        $next = $this->params()->fromQuery('next', $this->url()->fromRoute(
			            $this->profileRouteName,['id' =>$this->id2Short($user->getId())]
			        ));                	
                    //OK! User logged in successfully
                    return $this->redirect()->toUrl($next);
                }
                // else, authentication error
                $errors = [];
                foreach ($result->getMessages() as $k => $v) {
                    $errors[$k] = $this->getServiceLocator()->get('translator')->translate($v);
                }

                // FIXME: find a better way to handle errors
                $loginForm->setMessages(array('email' => $errors));
            }
        }

        return new ViewModel([
           'loginForm' => $loginForm
        ]);

    }

    public function registrationAction()
    {
        $prg = $this->prg();
        if ($prg instanceof Response) {
            return $prg;
        }
        /* @var $registrationForm \User\Form\RegistrationForm */
    	$registrationForm = $this->serviceLocator->get('FormElementManager')->get('User\Form\RegistrationForm');
    	/* @var $user \User\Model\EntityUserEntity */
    	$user = $this->userModel->create();
    	$registrationForm->bind($user);

    	if (is_array($prg)) {
    		
    	    $registrationForm->setData($prg);
    	    if ($registrationForm->isValid()) {
                $user->save();
               $viewModel = new ViewModel();
                $viewModel->setTemplate('user/user/thank-you');
               return $viewModel;
                
                /*return $this->redirect()->toUrl($this->url()->fromRoute(
            		$this->profileRouteName
        		));*/
    	    }
    	    // else... show errors
    	}

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

    /**
     * @throws \Exception
     * @return \User\Model\Entity\UserEntity
     */
    protected function getUser()
    {
    	$id = $this->id2Normal($this->params()->fromRoute('id'));
    	
    	/* @var $user  \User\Model\Entity\UserEntity */
    	$user = $this->userModel->findById($id)->current();    	
    	
    	if(!$user)
    		throw new \Exception('User not found!');

    	return $user;
    }
    
    public function profileAction()
    {
		$user = $this->getUser();
    	
    	return new ViewModel([
           'user' => $user 
    	]);
    }

    public function profileEditAction()
    {
       $user = $this->getUser();
    	
       //check permission
       if (!$this->isAllowed($user, 'edit')) {
            throw new UnAuthorizedException();
        }    	
    	
        $prg = $this->prg();
        if ($prg instanceof Response) {
            return $prg;
        }
        /* @var $editProfileForm \User\Form\EditProfileForm */
    	$editProfileForm = $this->serviceLocator->get('FormElementManager')->get('User\Form\EditProfileForm');        
        if ($this->isAllowed($user, 'edit-roles')) {
            $editProfileForm->addRolesValidation();
        }     	
    	
    	$editProfileForm->bind($user);

    	if (is_array($prg)) {
    		$prg['user-fieldset']['id'] = $user->getId();//form id value filled safely
    	    $editProfileForm->setData($prg);
    	    if ($editProfileForm->isValid()) {
                $user->save();

                $this->flashMessenger()->addSuccessMessage(Message::SUCCESS_GLOBAL);
            
                return $this->redirect()->toUrl($this->url()->fromRoute(
            		$this->profileRouteName,['id' =>$this->id2Short($user->getId())]
        		));
    	    }
    	    // else... show errors
    	    //$editProfileForm->getMessages()
    	}

    	return new ViewModel([
		   'user' => $user,
           'editProfileForm' => $editProfileForm
    	]);        

    }

    public function profileRemoveAction()
    {
    	return new ViewModel();
    }
    
    public function adminOnlyAction()
    {
    	return new ViewModel();
    }

}

