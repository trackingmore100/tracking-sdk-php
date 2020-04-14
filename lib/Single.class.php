<?php
namespace APITracking;
class Single extends Api
{
	public static function get($trackingNumber, $trackingExpress, $trackingLang = "")
	{
		$check = self::check($trackingNumber, $trackingExpress, $trackingLang);
		if($check !== true) return $check;
		if(!empty(self::$trackingLang)) self::$apiPath .= "/" . strtolower(self::$trackingLang);
		return self::sendApiRequest();
	}
	public static function create($params)
	{
		if(empty($params) || !is_array($params)) return self::errorResponse(4501);
		self::$apiPath = "trackings/post";
		$check = self::checkParamsRequirements($params);
		if($check !== true) return self::errorResponse($check);
		return self::sendApiRequest($params);
	}
	public static function update($trackingNumber, $trackingExpress, $params = [])
	{
		$check = self::check($trackingNumber, $trackingExpress);
		if($check !== true) return $check;
		if(empty($params) || !is_array($params)) return self::errorResponse(4501);
		return self::sendApiRequest($params, "PUT");
	}
	public static function del($trackingNumber, $trackingExpress)
	{
		$check = self::check($trackingNumber, $trackingExpress);
		if($check !== true) return $check;
		return self::sendApiRequest([], "DELETE");
	}
	public static function updateCode($params)
	{
		if(empty($params) || !is_array($params)) return self::errorResponse(4501);
		self::$apiPath = "trackings/update";
		self::$trackingExpress = empty($params["update_carrier_code"]) ? "" : trim($params["update_carrier_code"]);
		if(!self::checkExpressRequirements()) return 4015;
		$check = self::checkParamsRequirements($params);
		if($check !== true) return self::errorResponse($check);
		return self::sendApiRequest($params);
	}
	private static function check($trackingNumber, $trackingExpress, $trackingLang = "")
	{
		self::$trackingNumber = $trackingNumber;
		self::$trackingExpress = $trackingExpress;
		self::$trackingLang = $trackingLang;
		if(!self::checkLangRequirements()) self::$trackingLang = "";
		if(!self::checkNumberRequirements()) return self::errorResponse(4014);
		if(!self::checkExpressRequirements()) return self::errorResponse(4015);
		self::$apiPath = "trackings/{$trackingExpress}/{$trackingNumber}";
		return true;
	}
}