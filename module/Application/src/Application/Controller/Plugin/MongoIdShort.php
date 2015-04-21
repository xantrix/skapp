<?php
namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Application\Controller\Plugin\Service\MongoIdShortTrait;
use Application\Controller\Plugin\Service\MongoIdShortInterface;

class MongoIdShort extends AbstractPlugin implements MongoIdShortInterface
{
	use MongoIdShortTrait;
}

