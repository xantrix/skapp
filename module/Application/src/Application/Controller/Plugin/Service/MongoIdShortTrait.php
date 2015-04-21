<?php
namespace Application\Controller\Plugin\Service;

use Application\Model\Util;

trait MongoIdShortTrait 
{
	protected $mode;
	
	public function __construct($mode)
	{
		$this->mode = $mode;
	}
	
    /**
     * Convert a short/normal MongoId string
     * @param $id string
     * @return string
     */
    public function __invoke($id)
    {
        if($this->mode === self::MODE_NORMAL){
        	return Util::base64UrlSafeToHex($id);
        }else{
        	return Util::hexToBase64UrlSafe($id);
        }
    }	
}

