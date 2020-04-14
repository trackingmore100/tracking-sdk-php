<?php
/**
 * Get api key url https://my.trackingmore.com/get_apikey.php
 * Documentation url https://www.trackingmore.com/api-index.html
 */

# Introduce file class auto loading
require_once(dirname(__FILE__)."/Init.class.php");

# Pass api key parameter
\APITracking\Api::setApiKey("Your_Api_Key");

# Get a tracking number of real-time query result data
$data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
$response = \APITracking\Realtime::post($data);

# Get a list of all carriers
// $response = \APITracking\Courier::get();

# Create a tracking number
// $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
// $response = \APITracking\Single::create($data);

# Create multiple tracking numbers
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"]
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
// ];
// $response = \APITracking\Batch::create($data);

# Get logistics information for a tracking number
// $response = \APITracking\Single::get("RP325552475CN","china-post");

# Get logistics information for multiple tracking numbers
// $data = ["numbers" => "RP325552475CN,LZ448865302CN"];
// $response = \APITracking\Batch::get($data);

# Modify other information of a tracking number
// $data = ["order_id" => "#1234"];
// $response = \APITracking\Single::update("RP325552475CN","china-post",$data);

# Modify the information of multiple tracking numbers
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "order_id" => "#1234",],
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems", "order_id" => "#5678",],
// ];
// $response = \APITracking\Batch::update($data);

# Modify the carrier code of a tracking number
// $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "update_carrier_code" => "china-ems"];
// $response = \APITracking\Single::updateCode($data);

# Delete a tracking number
// $response = \APITracking\Single::del("RP325552475CN","china-post");

# Delete multiple tracking numbers
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
// ];
// $response = \APITracking\Batch::del($data);

# Set multiple tracking numbers no longer update
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
// ];
// $response = \APITracking\Batch::notUpdate($data);

# Get status statistics of tracking ticket number
// $data = ["created_at_min" => time() - 3600 * 24 * 30, "created_at_max" => time()];
// $response = \APITracking\Status::get($data);

# Get user information
// $response = \APITracking\User::get();

# Query whether remote
// $data = [
// 	["country" => "Japan", "postcode" => "7621094"],
// 	["country" => "NZ", "postcode" => "Papaaroha"],
// ];
// $response = \APITracking\Remote::post($data);

# Get the timeliness of multiple carriers
// $data = [
// 	["original" => "CN", "destination" => "US", "carrier_code" => "dhl"],
// 	["original" => "CN", "destination" => "RU", "carrier_code" => "dhl"],
// ];
// $response = \APITracking\Costtime::post($data);

# Obtain real-time query data of air tracking number
// $data = ["track_number" => "172-28891936"];
// $response = \APITracking\Aircargo\Realtime::post($data);


var_dump($response);