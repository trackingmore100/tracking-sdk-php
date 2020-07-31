<?php

namespace APITracking;

class RequestApi
{
	
	# @var string The url to be used for requests.
	public static $url = null;
	
	# @var array The params to be used for requests.
	public static $params = [];
	
	# @var array The header to be used for requests.
	public static $header = [];
	
	# @var int The header to be used for requests.
	public static $timeout = 60;
	
	# @var boolean The header to be used for requests.
	public static $isHeader = false;
	
	/**
	* send api request.
	*
	* @return string $response.
	*/
	public static function send($method = "GET")
	{
		$method = strtoupper($method);
		if(
			empty(self::$url) 
			|| empty(self::$header)
		) return "";
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, self::$url);
		if(
			!empty(self::$params) 
			&& $method == "GET"
		) $method = "POST";
		if(
			!empty(self::$params) 
			&& !is_string(self::$params)
		) self::$params = json_encode(self::$params);
		switch($method)
		{
			case "GET" :
				curl_setopt($curl, CURLOPT_HTTPGET, true);
				break;
			case "POST" :
				curl_setopt($curl, CURLOPT_POST, true);
				break;
			default :
				curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
				break;
		}
		if(preg_match("/^https/", self::$url)){
		    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		}
		curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($curl, CURLOPT_TIMEOUT, self::$timeout);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HEADER, self::$isHeader);
		if(!empty(self::$params))
		{
			curl_setopt($curl, CURLOPT_POSTFIELDS, self::$params);
			self::$header[] = "Content-Length: " . strlen(self::$params);
		}
		curl_setopt($curl, CURLOPT_HTTPHEADER, self::$header);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
		$response = curl_exec($curl);
		curl_close($curl);
		unset($curl); 
		return (string)$response;
	}
	
}