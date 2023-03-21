
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('getData.php');

function requestProcessor($request) {
  	echo "received request".PHP_EOL;
  	//var_dump($request);
  	if(!isset($request['type'])) {
    		return "ERROR: unsupported message type";
  	}
	switch ($request['type'])
  	{
		case "Request":
			return getData($request['search'], "search");
			break;
		case "Lookup":
			echo $request['showID'];
			return getData($request['showID'], "lookup");
			break;
	}
	//echo 'here';
	//echo $request['type'];
  	//return array("returnCode" => '0', 'message'=>"dmz error");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>

