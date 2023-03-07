
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
	
	$request = array();
	$request['type'] = "Login";
	$request['username'] = $username;
	$request['password'] = $password;
	$request['message'] = $msg;

	echo 'before';
	$response = $client->send_request($request);
	echo 'after';
		
	echo "client received response: ".PHP_EOL;
	//echo $response;
	if ($response == "1") {
		return true;
	}else {
		return false;
	}	

}
echo sendLogin('test','test');
//print_r($response);
//echo "\n\n";
//echo $argv[0]." END".PHP_EOL;

