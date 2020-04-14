<?php
namespace APITracking\Aircargo;
class Realtime extends Api
{
	public static function post($params)
	{
		self::$apiPath = "trackings/aircargo";
		if(empty($params) || !is_array($params)) return self::errorResponse(4501);
		return self::sendApiRequest($params);
	}
}