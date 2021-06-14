<?php

namespace ZhyuInfo\Sms;

class MobileNumber
{
	private static $country_code = '886';

	public function setCountryCode(string $country_code){
	    self::$country_code = $country_code;
    }

	public static function encode(string $mobile){
		if(strlen($mobile)!=10){
			throw new \Exception('mobile number must contains 10 number');
		}
		return self::$country_code.substr($mobile, 1, 9);
	}

	public static function decode($mobileWithCountryCode){
		if(strlen($mobileWithCountryCode)!=12){
			throw new \Exception('mobileWithCountryCode number must contains 12 number');
		}
		return preg_replace('^'.self::$country_code, '0', $mobileWithCountryCode);
	}
	
}