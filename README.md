# Tracking PHP SDK

This SDK was created to enable rapid efficient development using Trackingmore's API.

## Manual Installation

```php
require_once('./Init.class.php');
```

## Getting Started

In order to use this API, you need to generate a Tracking API key in the [TrackingMore](https://www.trackingmore.com), Setting > [Get API key](https://my.trackingmore.com/get_apikey.php).
Simple usage looks like:

```php
\APITracking\Api::setApiKey("Your_Api_Key");
```

## Documentation

See the [API docs](https://www.trackingmore.com/api-index.html).

### Get a tracking number of real-time query result data

```php
$data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
$response = \APITracking\Realtime::post($data);
var_dump($response);
```

### Get a list of all carriers that support the query

```php
$response = \APITracking\Courier::get();
var_dump($response);
```

### Create a tracking number

```php
$data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"];
$response = \APITracking\Single::create($data);
var_dump($response);
```

### Create multiple tracking numbers

```php
$data = [
	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"]
	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
];
$response = \APITracking\Batch::create($data);
var_dump($response);
```

### Get a tracking number of logistics information

You need to make sure this tracking number has been created before

```php
$response = \APITracking\Single::get("RP325552475CN","china-post");
var_dump($response);
```

### Get logistics information for multiple tracking numbers

Before retesting, you need to make sure that this tracking numbers has been created

```php
$data = ["numbers" => "RP325552475CN,LZ448865302CN"];
$response = \APITracking\Batch::get($data);
var_dump($response);
```

### Update other information of a tracking number

You need to make sure this tracking number has been created before

```php
$data = ["order_id" => "#1234"];
$response = \APITracking\Single::update("RP325552475CN","china-post",$data);
var_dump($response);
```

### Modify the information of multiple tracking numbers

Before retesting, you need to make sure that this tracking numbers has been created

```php
$data = [
	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "order_id" => "#1234",],
	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems", "order_id" => "#5678",],
];
$response = \APITracking\Batch::update($data);
var_dump($response);
```

### Modify a tracking carrier number

You need to make sure this tracking number has been created before

```php
$data = ["tracking_number" => "RP325552475CN", "carrier_code" => "china-post", "update_carrier_code" => "china-ems"];
$response = \APITracking\Single::updateCode($data);
var_dump($response);
```

### Delete a tracking number

You need to make sure this tracking number has been created before

```php
$response = \APITracking\Single::del("RP325552475CN","china-post");
var_dump($response);
```

### Delete multiple tracking numbers

You need to make sure this tracking number has been created before

```php
$data = [
	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
];
$response = \APITracking\Batch::del($data);
var_dump($response);
```

### Set multiple tracking numbers no longer update

You need to make sure this tracking number has been created before

```php
$data = [
	["tracking_number" => "RP325552475CN", "carrier_code" => "china-post"],
	["tracking_number" => "LZ448865302CN", "carrier_code" => "china-ems"],
];
$response = \APITracking\Batch::notUpdate($data);
var_dump($response);
```

### Get status statistics of tracking number

```php
$data = ["created_at_min" => time() - 3600 * 24 * 30, "created_at_max" => time()];
$response = \APITracking\Status::get($data);
var_dump($response);
```

### Get user information

```php
$response = \APITracking\User::get();
var_dump($response);
```

### Query whether remote

```php
$data = [
	["country" => "Japan", "postcode" => "7621094"],
	["country" => "NZ", "postcode" => "Papaaroha"],
];
$response = \APITracking\Remote::post($data);
var_dump($response);
```

### Get the timeliness of multiple carriers

```php
$data = [
	["original" => "CN", "destination" => "US", "carrier_code" => "dhl"],
	["original" => "CN", "destination" => "RU", "carrier_code" => "dhl"],
];
$response = \APITracking\Costtime::post($data);
var_dump($response);
```

### Obtain real-time query data of air tracking number

```php
$data = ["track_number" => "172-28891936"];
$response = \APITracking\Aircargo\Realtime::post($data);
var_dump($response);
```

## Typical Server Responses

We will respond with one of the following status codes.

Code | Description
----|------
200	|	OK - The request was successful (some API calls may return 201 instead).
201	|	Created - The request was successful and a resource was created.
202 |	Created - The request was successful but exceeding the limit.
401	|	Unauthorized - Authentication failed or user does not have permissions for the requested operation.
4001|	Unauthorized - Invalid API key.
4002|	Unauthorized - API key has been deleted.
4012|	Bad Request - The request could not be understood or was missing required parameters.
4013|	Bad Request - Tracking_number is required.
4014|	Bad Request - The value of `tracking_number` is invalid.
4015|	Bad Request - The value of `carrier_code` is invalid.
4016|	Bad Request - Tracking already exists.
4017|	Bad Request - Tracking does not exist.
4018|	Bad Request - Due to overload risks this feature requires custom activation. Contact service@trackingmore.org for more information.
4020|	Bad Request - Up to 200 at a time
4021|	Bad Request - Your remaining balance is not enough, so you can not call the API request data.
4031|	No Content - The request was successful but the response is empty.
4032|	No Content - Cannot detect courier.
4033|	No Content - The value of `status` is invalid.
402	|	Payment Required - Payment required.
403	|	Forbidden - Access denied.
404 |	Not Found - Resource was not found.
405	|	Method Not Allowed - Requested method is not supported for the specified resource.
409	|	Conflict - The request could not be completed due to a conflict.
429 |	Too Many Requests - Exceeded API limits. Pause requests, wait two minute, and try again.
500	|	Server error
503	|	Service Unavailable - The service is temporary unavailable (e.g. scheduled Platform Maintenance). Try again later.