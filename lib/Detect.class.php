<?php
namespace APITracking;
class Detect extends Api
{
	public static function post($tracking_number, $lang = null)
	{
		self::$apiPath = "carriers/detect";
		if(empty($tracking_number) && !self::checkNumberRequirements($tracking_number)) return "";
		$params = ["tracking_number" => $tracking_number];
		if(!empty($lang) && is_string($lang)) $params["lang"] = $lang;
		return self::sendApiRequest($params);
	}
}