
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
	
	$response = $client->send_request($request);
	
		
	//echo "client received response: ".PHP_EOL;

	if ($response == "1") {
		return true;
	}else {
		return false;
	}	

}

function showRequest($searchBar) {
	if (isset($argv[1])) {
		$msg = $argv[1];
	} else {
		$msg = "still idk";
	}

	$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
	$request = array();
	$request['type'] = "Request";	
	$request['search'] = $searchBar;
	$request['message'] = $msg;

	$response = $client->send_request($request);

	return ($response);
}
