#!/usr/bin/php
<?php

//$mydb = new mysqli('127.0.0.1','dbmaster','12345','it490');

function doLogin($username, $password) {
	$mydb = new mysqli('127.0.0.1','dbmaster','12345','it490');
	if ($mydb->errno != 0)
	{
		echo "failed to connect to database: ". $mydb->error . PHP_EOL;
		exit(0);
	}
	echo "successfully connected to database".PHP_EOL;

	$un = $mydb->real_escape_string($username);
	$pw = $mydb->real_escape_string($password);
	$query = "select * from users where username = '$un'";
	$response = $mydb->query($query);
	
	while($row = $response->fetch_assoc()) {
		echo "checking password $un".PHP_EOL;
		if ($row["password"] == $pw) {
			echo "passwords match for $username".PHP_EOL;
			return 1;
		}
		echo "passwords did not match for $un".PHP_EOL;
	}
	echo "no matching users";
	return 0;
	/*
	if ($response = $mydb->query($query)) {
		return ($response-> fetch_all(MYSQLI_ASSOC));
		$response -> free_result();
	}
	*/

	if ($mydb->errno != 0)
	{
		echo "failed to execute query:".PHP_EOL;
		echo __FILE__.':'.__LINE__.":error: ".$mydb->error.PHP_EOL;
		exit(0);
	}
}

?>
