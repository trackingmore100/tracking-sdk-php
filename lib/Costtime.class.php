<?php
namespace APITracking;
class Costtime extends Api
{
	public static function post($data)
	{
		self::$apiPath = "trackings/costtime";
		if(empty($data) || !is_array($data)) return self::errorResponse(4501);
		$params = [];
		foreach($data as $value)
		{
			if(
				empty($value["carrier_code"])
				|| empty($value["original"])
				|| empty($value["destination"])
			) continue;
			$params[] = $value;
		}
		if(empty($params)) return self::errorResponse(4501);
		return self::sendApiRequest($params);
	}
}