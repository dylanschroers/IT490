<?php
require 'callAPI.php';
$get_data = callAPI('POST', 'https://api.tvmaze.com/search/shows?q=girls', false);
$response = json_decode($get_data, true);
foreach ($response as $resultShow) {
	print_r($resultShow['show']['name']."\n");
}
?>
