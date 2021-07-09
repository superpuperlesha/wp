<?php


//===twilio===
define('twilio_sid',                                 'ACaf0f0c655a445ee633d979bf3a249230');
define('twilio_token',                               'ea9e2571c753e5e857a979c82fc715d7');
define('twilio_phone_number',                        '+15017250604');
require_once(dirname(__FILE__).'/twilio/src/Twilio/autoload.php');


//===TWILIO SMSing===
function siteSMS($phone, $message){
	//use \Twilio\Rest\Client;
	$client = new \Twilio\Rest\Client(twilio_sid, twilio_token);
	$client->messages->create(
		$phone, // the number you'd like to send the message to
		array(
			'from' => twilio_phone_number, // A Twilio phone number you purchased at twilio.com/console
			'body' => $message // the body of the text message you'd like to send
		)
	);
}


