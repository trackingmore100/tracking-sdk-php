<?php
namespace APITracking;
class Realtime extends Api
{
	public static function post($params)
	{
		self::$apiPath = "trackings/realtime";
		$check = self::checkParamsRequirements($params);
		if($check !== true) return self::errorResponse($check);
		return self::sendApiRequest($params);
	}
}