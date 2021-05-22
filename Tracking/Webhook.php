<?php

namespace Tracking;

class Webhook
{
    use Request;

    public $requestJson;
    public $requestArr;

    public function get($verifyEmail = "")
    {
        $requestJson = file_get_contents("php://input");
        preg_match("/{.*}/", $requestJson, $match);
        $this->requestJson = empty($match[0]) ? "" : $match[0];
        $this->requestArr = empty($this->requestJson) ? [] : json_decode($this->requestJson, true);
        if (empty($this->requestArr)) return $this->errorResponse(4503, "", $requestJson);
        if (
            !empty($verifyEmail)
            && is_string($verifyEmail)
        ) {
            if (!$this->verify($verifyEmail)) return $this->errorResponse(4502, "", $requestJson);
        }
        return $this->requestJson;
    }

    public function verify($verifyEmail)
    {
        $verifyInfo = isset($this->requestArr["verifyInfo"]) ? $this->requestArr["verifyInfo"] : [];
        $timeStr = empty($verifyInfo["timeStr"]) ? null : $verifyInfo["timeStr"];
        $signature = empty($verifyInfo["signature"]) ? null : $verifyInfo["signature"];
        if (
            empty($timeStr)
            || empty($signature)
        ) return false;
        $result = hash_hmac("sha256", $timeStr, $verifyEmail);
        return strcmp($result, $signature) == 0 ? true : false;
    }
}