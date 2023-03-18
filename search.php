<?php
if (!isset($_POST)) {
	$msg = 'no post msg, fuck off';
	echo json_encode($msg);
	exit(0);
}

$request = $_POST;
$response = "unsupported request type, fuck off";

require('rabbitMQClient.php');

if ($request['type'] == "search") {
	$result = json_decode(showRequest($request["sname"]),true);
	foreach ($result as $sname)
		echo ("<a class='post' href='newpage.php?name=".$sname['show']['name']."
		&id=".$sname['show']['id']."'>".$sname['show']['name']."</a><br>");
} elseif ($request['type'] == "lookup") {
	$result = (showLookup($request["sid"]));
	print_r($result);
}

exit(0);
