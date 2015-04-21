<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Application\Controller\Plugin\Service\MongoIdShortTrait;
use Application\Controller\Plugin\Service\MongoIdShortInterface;

class MongoIdShort extends AbstractHelper implements MongoIdShortInterface
{
	use MongoIdShortTrait;
}

