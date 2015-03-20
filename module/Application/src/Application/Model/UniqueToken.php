<?php
namespace Application\Model;

use Zend\Math\Rand;

abstract class UniqueToken
{
	const TOKEN_LENGTH = 32; //@TODO choose an appropriate length
	const TOKEN_CHARLIST =  'abcdefghijklmnopqrstuvwxyz1234567890';
	
    public static function getToken()
    {
        return Rand::getString(
            self::TOKEN_LENGTH,
            self::TOKEN_CHARLIST,
            true // strong
        );
    }

}