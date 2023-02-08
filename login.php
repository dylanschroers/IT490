<?php
if (!isset($_POST))
{
	$msg = "NO POST MESSAGE SET, POLITELY FUCK OFF";
	echo json_encode($msg);
	exit(0);
}
$request = $_POST;
$response = "unsupported request type, politely FUCK OFF";
/*
function sendLogin($un,$pw) {
	return true;
}
 */


require_once('rabbitMQClient.php');

if ($request["type"] == "login") {

	if (sendLogin($request["uname"],$request["pword"])) {
		$response = "in the db";
	}else {
		$response = "not in the db";
	}

	//$response = "to here";
}

echo json_encode($response);
exit(0);

?>
