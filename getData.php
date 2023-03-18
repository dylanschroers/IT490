<?php
require 'callAPI.php';
function getData($callVal, $callType) {
	if ($callType == "search") {
		return (callAPI('GET', 'https://api.tvmaze.com/search/shows?q='.$callVal, false));
	} elseif ($callType == "lookup") {
		return (callAPI('GET', 'https://api.tvmaze.com/shows/'.$callVal, false));
	}
}
?>
