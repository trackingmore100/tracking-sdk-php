<?php
/**
 * setting webhook url https://my.trackingmore.com/webhook_setting.php
 * Documentation url https://www.trackingmore.com/webhook.html
 */

# Introduce file class auto loading
if (!defined("TRACKING_AUTOLOADER_PATH"))
{
    define("TRACKING_AUTOLOADER_PATH", __DIR__);
}
require_once(__DIR__ ."/Autoloader.php");
use Tracking\Webhook;

# If you need a data signature to verify whether the source of the data comes from an account of trackingmore, please fill in your account login mailbox. If the verification fails, it will intercept the data
$verifyEmail = "";
$webhook = new Webhook();
# Get webhook content
$response = $webhook->get($verifyEmail);

# Write the push content to the log file, note: read and write permissions are required
file_put_contents(__DIR__."/webhook.txt",$response."\r\n",FILE_APPEND);

# If you pass the data review logic and return a 200 status code, here is just a simple example
if(!empty($response)) echo "200";

exit;