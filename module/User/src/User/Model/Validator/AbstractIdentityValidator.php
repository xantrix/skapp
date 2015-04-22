<?php
namespace User\Model\Validator;

use Zend\Validator\AbstractValidator;
use Matryoshka\Model\Model;
use Matryoshka\Model\Criteria\ReadableCriteriaInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractIdentityValidator extends AbstractValidator
{
    /**
     * Error constants
     */
    const ERROR_NO_RECORD_FOUND = 'noRecordFound';
    const ERROR_RECORD_FOUND    = 'recordFound';
    /**
     * @var array Message templates
     */
    protected $messageTemplates = array(
        self::ERROR_NO_RECORD_FOUND => "No record matching the input was found",
        self::ERROR_RECORD_FOUND    => "A record matching the input was found",
    );

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var ReadableCriteriaInterface
     */
    protected $criteria;

    /**
     * @var string
     */
    protected $identityField = 'email';

    protected $excludePrefix = 'exclude';
    
    protected $excludeField = '';

    /**
	 * @return the $excludeField
	 */
	public function getExcludeField() {
		return $this->excludeField;
	}

	/**
	 * @param string $excludeField
	 */
	public function setExcludeField($excludeField) {
		$this->excludeField = $excludeField;
	}

	public function setCriteria(ReadableCriteriaInterface $criteria)
    {
        $this->criteria = $criteria;
        return $this;
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
        return $this;
    }

    public function findIdentity($identity, $context = null)
    {
        $hydrator = new ClassMethods();
        $data = [
            $this->identityField => $identity
        ];
        if($this->excludeField){
        	$data[ $this->excludePrefix . $this->excludeField ] = $context[$this->excludeField];
        }
        
        $criteria = clone $this->criteria;
        $hydrator->hydrate($data, $criteria);
        return $this->model->find($criteria)->current();
    }

    //TODO: add other setter and getters

}