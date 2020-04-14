<?php
namespace APITracking\Aircargo;
class Api extends \APITracking\Api
{
	
	# @var string The pattern number.
	public static $airPatternNumber = "/^([0-9]{3})([ \-]{1})?([0-9]{7,8})$/";
	
	# @var string The tracking number.
	public static $airNumber;
	
	/**
	* Check if the air number meets the requirements.
	*
	* @return boolean.
	*/
	public function checkAirNumberRequirements()
	{
		if(empty(self::$airNumber) || !is_string(self::$airNumber)) return false;
		return preg_match(self::$airPatternNumber,self::$airNumber);
	}
	
}