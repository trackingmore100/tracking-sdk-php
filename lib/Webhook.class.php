<?php
namespace APITracking;
class Webhook extends Api
{
	public static $requestJson;
	public static $requestArr;
	public static function get($verifyEmail = "")
	{
		$requestJson = file_get_contents("php://input");
		preg_match("/\{.*\}/",$requestJson,$match);
		self::$requestJson = empty($match[0]) ? "" : $match[0];
		self::$requestArr = empty(self::$requestJson) ? [] : json_decode(self::$requestJson,true);
		if(empty(self::$requestArr)) return self::errorResponse(4503,"",$requestJson);
		if(
			!empty($verifyEmail) 
			&& is_string($verifyEmail)
		){
			if(!self::verify($verifyEmail)) return self::errorResponse(4502,"",$requestJson);
		}
		return self::$requestJson;
	}
	public static function verify($verifyEmail)
	{
		$verifyInfo = isset(self::$requestArr["verifyInfo"]) ? self::$requestArr["verifyInfo"] : [];
		$timeStr = empty($verifyInfo["timeStr"]) ? null : $verifyInfo["timeStr"];
		$signature = empty($verifyInfo["signature"]) ? null : $verifyInfo["signature"];
		if(
			empty($timeStr) 
			|| empty($signature)
		) return false;
		$result = hash_hmac("sha256",$timeStr,$verifyEmail);
		return strcmp($result,$signature) == 0 ? true : false;
	}
}