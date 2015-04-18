<?php
namespace Application\Model;

abstract class Util 
{
	
	/**
	 * Encode e.g. 47cc67093475061e3d95369d -> R8xnCTR1Bh49lTad
	 * http://sebastian.formzoo.com/2012/04/12/mongodb-shorten-the-objectid/
	 * @param string $hexString
	 * @return string
	 */
	public static function hexToBase64UrlSafe($hexString)
	{
		// Encode
		$str = base64_encode(hex2bin($hexString));
		$str = str_replace('+', '-', $str);
		$str = str_replace('/', '_', $str);
		return $str;
	}

	/**
	 * Decode e.g. R8xnCTR1Bh49lTad -> 47cc67093475061e3d95369d
	 * @param string $base64String
	 * @return string
	 */
	public static function base64UrlSafeToHex($base64String)
	{
		// Decode
		$str = str_replace('-', '+', $base64String);
		$str = str_replace('_', '/', $str);
		$str = bin2hex(base64_decode($str));
		return $str;
	}
	
}
