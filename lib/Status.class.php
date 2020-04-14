<?php
namespace APITracking;
class Status extends Api
{
	public static function get($params = [])
	{
		self::$apiPath = "trackings/getstatusnumber";
		if(!empty($params) && is_array($params)) self::$apiPath .= "?" . http_build_query($params);
		return self::sendApiRequest();
	}
}