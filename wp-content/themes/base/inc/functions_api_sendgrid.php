<?php

//===SENDGRID===
define('SendGridKeySec', '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');
require_once(dirname(__FILE__).'/sendgrid/vendor/autoload.php');

//===EMAILING===
function sgMail($to, $subject, $content){
	if(filter_var($to, FILTER_VALIDATE_EMAIL)){
		$email = new \SendGrid\Mail\Mail();
		$email->setFrom('support@wona.io', 'Wona.io Support Team');
		$email->setSubject($subject);
		$email->addTo($to, 'Wona site');
		$email->addContent('text/html', $content); // "text/plain"
		$sendgrid = new \SendGrid(SendGridKeySec);
		try{
			$response = $sendgrid->send($email);
			return true;
		}catch(Exception $e){
			return false;
		}
	}else{
		return false;
	}
}