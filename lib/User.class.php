<?php
namespace APITracking;
class User extends Api
{
	public static function get()
	{
		self::$apiPath = "trackings/getuserinfo";
		return self::sendApiRequest();
	}
}