<?php
/**
 * Get api key url https://my.trackingmore.com/get_apikey.php
 * Documentation url https://www.trackingmore.com/api-index.html
 */

# Introduce file class auto loading

if (!defined("TRACKING_AUTOLOADER_PATH")) {
    define("TRACKING_AUTOLOADER_PATH", __DIR__);
}
require_once(__DIR__ . "/Autoloader.php");

use Tracking\Api;

# Pass api key parameter
$api = new Api('you api key');
#sandbox model
//$api->sandbox = true;
# Get a tracking number of real-time query result data
//$data = ["tracking_number" => "UB209300714LV", "carrier_code" => "cainiao"];
//$response = $api->realtime($data);

# archive
$data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
$response = $api->archive($data);

# Get a list of all carriers
// $response = $api->courier();

# Create a tracking number
// $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
// $response = $api->create($data);

# Create multiple tracking numbers
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
// ];
// $response =$api->create($data);

# Get logistics information for a tracking number
// $response = $api->get("RP325552475CN","china-post");

# Get logistics information for multiple tracking numbers
// $data = ["tracking_number" => "RP325552475CN,LZ448865302CN"];
// $response = $api->get($data);

# Modify other information of a tracking number
//$data = ['num'=>"RP325552475CN",'carrier_code'=>"china-post","order_id" => "#1234"];
// $response = $api->modifyinfo($data);

# Modify the information of multiple tracking numbers
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "order_id" => "#1234",],
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems", "order_id" => "#5678",],
// ];
// $response =  $api->modifyinfo($data);

# Modify the carrier code of a tracking number
// $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "new_carrier_code" => "china-ems"];
// $response =  $api->modifyCourier($data);

# Delete a tracking number
// $response = $api->delete("RP325552475CN","china-post");

# Delete multiple tracking numbers
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
// ];
// $response = $api->delete($data);

# Set multiple tracking numbers no longer update
// $data = [
// 	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
// 	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
// ];
// $response = $api->notUpdate($data);

# Get status statistics of tracking ticket number
// $data = ["created_at_min" => time() - 3600 * 24 * 30, "created_at_max" => time()];
// $response = $api->status($data);

# Get user information
// $response =  $api->user();

# Query whether remote
// $data = [
// 	["country" => "Japan", "postcode" => "7621094"],
// 	["country" => "NZ", "postcode" => "Papaaroha"],
// ];
// $response = $api->remote($data);

# Get the timeliness of multiple carriers
// $data = [
// 	["original" => "CN", "destination" => "US", "carrier_code" => "dhl"],
// 	["original" => "CN", "destination" => "RU", "carrier_code" => "dhl"],
// ];
// $response = $api->transitTime($data);

# Obtain real-time query data of air tracking number
//$data = ["track_number" => "172-28891936"];
//$response = $api->airRealtime($data);


var_export($response);