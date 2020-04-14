<?php
namespace APITracking;
class Courier extends Api
{
	public static function get()
	{
		self::$apiPath = "carriers/";
		return self::sendApiRequest();
	}
}