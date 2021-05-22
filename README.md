Trackingmore-PHP
=================

The PHP SDK of Trackingmore API
## Official document

[Document](https://www.trackingmore.com/v3/api-index)

##Init
```php
if (!defined("TRACKING_AUTOLOADER_PATH")) {
    define("TRACKING_AUTOLOADER_PATH", __DIR__);
}
require_once(__DIR__ . "/Autoloader.php");
use Tracking\Api;

# Pass api key parameter
$api = new Api('you api key');
```


Quick Start
--------------
- Put your ApiKey in the constructor of the Api class
- All returns are in Json format.
- After instantiating the Api class, you can use its interface methods
- You can set the sandbox of the Api instance to true to turn on the sandbox mode: <code>$api->sandbox=true;</code>
- Most Api params receive multiple tracking numbers

**Get a list of the couriers in Trackingmore**

    $response = $api->courier();

**Detect which couriers defined in your account match a tracking number**

    $data = ['tracking_number': 'EA152563254CN']
    $response = $api->detect($data);


**Post trackings to your account**

    //Create single tracking numbers
    $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
    //Create multiple tracking numbers
    $data = [
        ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
        ["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
    ];
    $response =$api->create($data);

**Summary of Connection API Methods with all the api and Methods**

    #sandbox model
    $api->sandbox = true;
    # Get a tracking number of real-time query result data
    //$data = ["tracking_number" => "UB209300714LV", "carrier_code" => "cainiao"];
    //$response = $api->realtime($data);
    
    # archive
    $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
    $response = $api->archive($data);
    
    # Get a list of all carriers
    $response = $api->courier();
    
    # Create a tracking number
    $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
    $response = $api->create($data);
    
    # Create multiple tracking numbers
    $data = [
    ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
    ["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
    ];
    $response =$api->create($data);
    //
    # Get logistics information for a tracking number
    $response = $api->get("RP325552475CN","china-post");
    
    # Get logistics information for multiple tracking numbers
    $data = ["tracking_number" => "RP325552475CN,LZ448865302CN"];
    $response = $api->get($data);
    
    # Modify other information of a tracking number
    $data = ['num'=>"RP325552475CN",'carrier_code'=>"china-post","order_id" => "#1234"];
    $response = $api->modifyinfo($data);
    
    # Modify the information of multiple tracking numbers
    $data = [
    ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "order_id" => "#1234",],
    ["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems", "order_id" => "#5678",],
    ];
    $response =  $api->modifyinfo($data);
    
    # Modify the carrier code of a tracking number
    $data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "new_carrier_code" => "china-ems"];
    $response =  $api->modifyCourier($data);
    
    # Delete a tracking number
    $response = $api->delete("RP325552475CN","china-post");
    
    # Delete multiple tracking numbers
    $data = [
    ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
    ["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
    ];
    $response = $api->delete($data);
    
    # Set multiple tracking numbers no longer update
    $data = [
    ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
    ["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
    ];
    $response = $api->notUpdate($data);
    
    # Get status statistics of tracking ticket number
    $data = ["created_at_min" => time() - 3600 * 24 * 30, "created_at_max" => time()];
    $response = $api->status($data);
    
    # Get user information
    $response =  $api->user();
    
    # Query whether remote
    $data = [
    ["country" => "Japan", "postcode" => "7621094"],
    ["country" => "NZ", "postcode" => "Papaaroha"],
    ];
    $response = $api->remote($data);
    
    # Get the timeliness of multiple carriers
    $data = [
    ["original" => "CN", "destination" => "US", "carrier_code" => "dhl"],
    ["original" => "CN", "destination" => "RU", "carrier_code" => "dhl"],
    ];
    $response = $api->transitTime($data);

## Typical Server Responses

We will respond with one of the following status codes.

Code|Type | Message
----|--------------|-------------------------------
200    | <code>Success</code>|    Request response is successful
203    | <code>PaymentRequired</code>|  API service is only available for paid account Please subscribe paid plan to unlock API services                                                             ul
204    | <code>No Content</code>|    Request was successful, but no data returned Tracking NO. or target data possibly do not exist
400    | <code>Bad Request</code>| Request type error Please check the API documentation for the request type of this API
401    | <code>Unauthorized</code>|    Authentication failed or has no permission Please check and ensure your API Key is correct
403    | <code>Bad Request</code>|    Page does not exist Please check and ensure your link is correct                                                                                             ul
404    | <code>Not Found</code>|    Page does not exist Please check and ensure your link is correct
408    | <code>Time Out</code>|    Request timeout The official website did not return data, please try again later
411    | <code>Bad Request</code>|    Specified request parameter length exceeds length limit Please check and ensure that the request parameters are of the required length
412    | <code>Bad Request</code>|    Specified request parameter format doesn't meet requirements Please check and ensure that the request parameters are in the required format
413    | <code>Out limited</code>|    The number of request parameters exceeds the limit Please check the API documentation for the limit of this API
417    | <code>Bad Request</code>|    Missing request parameters or request parameters cannot be parsed Please check and ensure that the request parameters are complete and correctly formatted
421    | <code>Bad Request</code>|    Some of required parameters are empty Some couriers need special parameters to track logistics information (Special Couriers)
422    | <code>Bad Request</code>|    Unidentifiable courier code Please check and ensure that the courier code are correct(Courier code)
423    | <code>Bad Request</code>|    Tracking No. already exists
424    | <code>Bad Request</code>|    Tracking No. no exists Please use 「Create trckings」 API first to create trackings
429    | <code>Bad Request</code>|    Exceeded API request limits, please try again later Please check the API documentation for the limit of this API
511    | <code>Server Error</code>|    Server error Please contact us: service@trackingmore.org.
512    | <code>Server Error</code>|    Server error Please contact us: service@trackingmore.org.
513    | <code>Server Error</code>|    Server error Please contact us: service@trackingmore.org.        