<?php
if (!isset($_POST)) {
	$msg = 'no post msg, fuck off';
	echo json_encode($msg);
	exit(0);
}

$request = $_POST;
$response = "unsupported request type, fuck off";

require('rabbitMQClient.php');

$request = array();
$request['sval'] = 'bad';
$request['type'] = 'search';

$result = (checkCache($request['sval'], $request['type']));

//print_r($result[0]);
print_r(json_encode($result));



exit(0);
