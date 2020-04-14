<?php
namespace APITracking;
class Remote extends Api
{
	public static function post($data)
	{
		self::$apiPath = "trackings/remote";
		if(empty($data) || !is_array($data)) return self::errorResponse(4501);
		$params = [];
		foreach($data as $value)
		{
			if(
				empty($value["country"])
				|| empty($value["postcode"])
			) continue;
			$params[] = $value;
		}
		if(empty($params)) return self::errorResponse(4501);
		return self::sendApiRequest($params);
	}
}