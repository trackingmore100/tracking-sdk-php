<?php
namespace APITracking;
class Batch extends Api
{
	public static function get($params = [])
	{
		self::$apiPath = "trackings/get";
		$page = empty($params["page"]) ? 1 : intval($params["page"]);
		$params["page"] = $page > 0 ? $page : 1;
		$limit = empty($params["limit"]) ? 50 : intval($params["limit"]);
		$params["limit"] = $limit > 0 ? $limit : 50;
		self::$trackingLang = empty($params["lang"]) ? "" : $params["lang"];
		$params["lang"] = self::checkLangRequirements() ? self::$trackingLang : "";
		$params["numbers"] = empty($params["numbers"]) ? "" : self::filterNumber($params["numbers"]);
		return self::sendApiRequest($params);
	}
	public static function create($data = [])
	{
		self::$apiPath = "trackings/batch";
		return self::checkSendApi($data);
	}
	public static function update($data = [])
	{
		self::$apiPath = "trackings/updatemore";
		return self::checkSendApi($data);
	}
	public static function del($data)
	{
		self::$apiPath = "trackings/delete";
		return self::checkSendApi($data);
	}
	public static function notUpdate($data = [])
	{
		self::$apiPath = "trackings/notupdate";
		return self::checkSendApi($data);
	}
	private static function filterNumber($number)
	{
		if(empty($number)) return "";
		if(!is_array($number)) $number = explode(",",$number);
		$number = array_values($number);
		$numberNew = [];
		foreach($number as $value){
			self::$trackingNumber = trim($value);
			if(!self::checkNumberRequirements()) continue;
			$numberNew[] = self::$trackingNumber;
		}
		return empty($numberNew) ? "" : implode(",", $numberNew);
	}
}