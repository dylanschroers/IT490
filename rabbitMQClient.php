#!/usr/bin/php
<?php

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function sendLogin($username, $password) {
	
	if (isset($argv[1])) {
		$msg = $argv[1];
	} else {
		$msg = "test message";
	}

	$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
	if (isset($argv[1]))
	$request = array();
	$request['type'] = "Login";
	$request['username'] = $username;
	$request['password'] = $password;
	$request['message'] = $msg;
	
	$response = $client->send_request($request);
	
		
	echo "client received response: ".PHP_EOL;
	if ($response == "1") {
		return true;
	}else {
		return false;
	}	

}

print_r($response);
echo "\n\n";
echo $argv[0]." END".PHP_EOL;

