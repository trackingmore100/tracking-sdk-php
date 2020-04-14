<?php
/**
 * setting webhook url https://my.trackingmore.com/webhook_setting.php
 * Documentation url https://www.trackingmore.com/webhook.html
 */

# Introduce file class auto loading
require_once(dirname(__FILE__)."/Init.class.php");

# If you need a data signature to verify whether the source of the data comes from an account of trackingmore, please fill in your account login mailbox. If the verification fails, it will intercept the data
$verifyEmail = "";

# Get webhook content
$response = \APITracking\Webhook::get($verifyEmail);

# Write the push content to the log file, note: read and write permissions are required
file_put_contents(dirname(__FILE__)."/webhook.txt",$response."\r\n",FILE_APPEND);

# If you pass the data review logic and return a 200 status code, here is just a simple example
if(!empty($response)) echo "200";

exit;