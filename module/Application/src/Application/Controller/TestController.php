<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\Criteria\UserCollectionCriteria;
use Application\Model\Object\Address\AddressObject;
use Application\Model\Object\Category\CategoryObject;
use Application\Model\Traits\PaginatorTrait;
use MongoDate;
use User\Model\Object\Role\RoleObject;
use User\Model\Object\Role\Collection\RoleCollection;
use User\Model\Entity\UserEntity;

class TestController extends AbstractActionController {

	use PaginatorTrait;
	
	/**
	 * @var \User\Model\UserModel
	 */
	protected $userModel;

	/**
	 * @var \User\Model\Entity\UserEntity
	 */
	protected $user;    
	
	public function indexAction()
    {
    	$this->userModel = $this->model()->get('User\Model\UserModel');

    	//create test list
    	if(true || $this->userModel->getDataGateway()->count() == 0){
	    	for ($i = 0; $i < 3; $i++) {
	    		$this->user = $this->userModel->create();//new empty
	    		$this->user->setEmail("test$i@test.com");
		    	$this->user->setPassword('password123');
		    	
		    	//set main address
		    	$mainAddress = new AddressObject();
		    	$mainAddress->setAddressCountry("country$i");
		    	$mainAddress->setAddressLocality("locality$i");
		    	$this->user->setAddress($mainAddress);
		    	//set collection fields
		    	$this->user->setRoles(new RoleCollection([ new RoleObject('guest'),  new RoleObject('user')]));
		    	$this->user->setCategories([ new CategoryObject('cat1'),  new CategoryObject('cat2')]);
		    	//set dates
		    	$this->user->setDateCreated(new \DateTime('now'));
		    	$this->user->setDob(new \DateTime('now'));
		    	
        		/* @var $registrationForm \User\Form\RegistrationForm */
    			$registrationForm = $this->serviceLocator->get('FormElementManager')->get('User\Form\RegistrationForm');		    	
		    	$registrationForm->bind($this->user);
		    	
		    	//form is populated with bound object values.
		    	$registrationForm->prepare();
		    	$emailFormValue = $registrationForm->get('user-fieldset')->get('email')->getValue();
		    	$dobFormValue = $registrationForm->get('user-fieldset')->get('dob')->getValue();
		    	$addressCountryFormValue = $registrationForm->get('user-fieldset')->get('address')->get('address_country')->getValue();
		    	$cat0FormValue = $registrationForm->get('user-fieldset')->get('categories')->get('0')->get('name')->getValue();
		    	$role0FormValue = $registrationForm->get('user-fieldset')->get('roles')->get('0')->get('role_id')->getValue();
				
				//set data
				$prg = [
		            'user-fieldset' => [
		                'email' => "Test$i@test.com",
		                'password' => 'Password123',
		                'dob' => '2015-08-15T00:00:00+0000',
		                'categories' => [
		                    ['name' => 'Cat1'],
		                    ['name' => 'Cat2'],
		                ],		                
		                'address' => [
		                	'address_country' => "Country$i",
		                	'address_locality' =>	"Locality$i",
		                ],
		                'roles' => [
		                    ['role_id' => 'Guest'],
		                    ['role_id' => 'User'],
		                ],		                
		            ]
		        ];		    	
		    	$registrationForm->setData($prg);
		    	$registrationForm->setValidationGroup([
	    			'user-fieldset' => [ //base fieldset
						'email',
	    				'password',
		    			'dob',
		    			'categories' => [ //collection fieldset item fields //FIXME
							'name'
				    	],
		                'address' => [ //nested fieldset
		                	'address_country',
		                	'address_locality',
		                	'postal_code',
		                	'street_address'	
		                ],
		                /*'roles' => [ //collection fieldset item fields
		                    'role_id'
		                ]*/		    			
	    			]
    			]);
		    	
		    	//valid and save
		    	if($registrationForm->isValid()){
			    	$this->user->save();
		    	}else{
		    		$errors = $registrationForm->getMessages();
		    	}
	    	}
    	}

    	/* @var $user  \User\Model\Entity\UserEntity */
    	$user = $this->userModel->findByIdentity('test0@test.com')->current();//get from persistence
    	if($user) 
    		$user->getDateCreated(); //php DateTime

		$from = '2015-02-20T00:00:00+0000';
		$to = '2015-05-01T00:00:00+0000';
    	
    	//$results = $this->userModel->findByRegistrationDateRange($from,$to);
    	$paginatorAdapter = $this->userModel->getPaginatorAdapter(
    			(new UserCollectionCriteria())->setCreatedDateFrom($from)->setCreatedDateTo($to)
		);
    	$paginator = $this->getPaginatorFromAdapter($paginatorAdapter);
		$paginator->setDefaultItemCountPerPage(5);
		$page = (int) $this->params()->fromQuery('page');
		if($page) $paginator->setCurrentPageNumber($page);
    	
    	//find all users with CallbackCriteria
		/*$users = $this->userModel->find(
		    new \Matryoshka\Model\Criteria\CallbackCriteria(
		        function ($model) {
		            $dataGateway = $model->getDataGateway();
		            return $dataGateway->find(
		            	['date_created' =>
		            		['$gt'=>new MongoDate(strtotime($from)),'$lt'=>new MongoDate(strtotime($to))]
						])->limit(100);
		        }
		    )
		);
		$users->count();*/
		
        return new ViewModel([
			'users' => $paginator
        ]);
    }	
}