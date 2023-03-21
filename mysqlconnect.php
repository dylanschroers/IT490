#!/usr/bin/php
<?php
require('rabbitMQClient.php');
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

function popDatabase($searchVal, $apiDrop) {

	$mydb = new mysqli('127.0.0.1','dbmaster','12345','it490');
	if ($mydb->errno != 0) {
		echo "failed to connect to database: ". $mydb->error.PHP_EOL;
		exit(0);
	}

	$sv = $mydb->real_escape_string($searchVal);
	$epochTime = time();
	
	$query = "INSERT INTO searchCache (search_val, lastmod) SELECT '$sv','$epochTime' FROM dual WHERE NOT EXISTS (SELECT 1 FROM searchCache where search_val = '$sv')";
	$mydb->query($query);



	foreach ($apiDrop as $show) {
		$apiID = $mydb->real_escape_string($show['show']['id']);
		$showName = $mydb->real_escape_string($show['show']['name']);
		if (isset($show['show']['image']['medium'])) {
			$showPicURL = $mydb->real_escape_string($show['show']['image']['medium']);
		} else {
			$showPicURL = null;
		}
		if (isset($show['show']['image']['medium'])) {
			$showRating = $mydb->real_escape_string($show['show']['rating']['average']);
		} else {
			$showRating = null;
		}
		if (isset($show['show']['image']['medium'])) {
			$showSum = $mydb->real_escape_string($show['show']['summary']);
		} else {
			$showSum = null;
		}

		$query = "INSERT INTO showCache (api_id, show_name, pic_url, rating, summary, lastmod) SELECT '$apiID','$showName','$showPicURL', '$showRating','$showSum','$epochTime' FROM dual WHERE NOT EXISTS (SELECT 1 FROM showCache where api_id = '$apiID')";
		$mydb->query($query);
		

		$query = "SELECT searchCache.search_id, showCache.show_id
				FROM searchCache JOIN showCache
				WHERE searchCache.search_val = '$sv'
				AND
				showCache.api_id = '$apiID'";
		$result = $mydb->query($query)->fetch_assoc();
		$searchID = $result['search_id'];
		$showID = $result['show_id'];

		$query = "INSERT INTO showSearch (search_id, show_id, lastmod) SELECT '$searchID', '$showID','$epochTime' FROM dual WHERE NOT EXISTS (SELECT 1 FROM showSearch where search_id = (SELECT search_ID FROM searchCache WHERE search_val = '$sv') AND show_id = (SELECT show_id FROM showCache WHERE api_id = '$apiID'))";
		$mydb->query($query);



		foreach($show['show']['genres'] as $genres) {
			if (isset($genres)) {
				$gv = $mydb->real_escape_string($genres);
			}
			$query = "INSERT INTO genreCache (genre_val, lastmod) SELECT '$gv','$epochTime' FROM dual WHERE NOT EXISTS (SELECT 1 FROM genreCache where genre_val = '$gv')";
			$mydb->query($query);

			$query = "SELECT genre_id FROM genreCache WHERE genre_val = '$gv'";
				
			$genreID = $mydb->query($query)->fetch_assoc()['genre_id'];

			$query = "INSERT INTO showGenre (show_id, genre_id, lastmod) SELECT '$showID', '$genreID','$epochTime' FROM dual WHERE NOT EXISTS (SELECT 1 FROM showGenre where show_id = (SELECT show_ID FROM showCache WHERE api_id = '$apiID') AND genre_id = (SELECT genre_id FROM genreCache WHERE genre_val = '$gv'))";
			$mydb->query($query);
		
		
		}
	}
}

function checkCache($checkVal, $checkType) {
	
	echo $checkVal;
	echo $checkType;

	$mydb = new mysqli('127.0.0.1','dbmaster','12345','it490');
	if ($mydb->errno != 0) {
		echo "failed to connect to database: ". $mydb->error.PHP_EOL;
		exit(0);
	}
	echo "connected to db".PHP_EOL;
	if ($checkType == "search") {
		$cv = $mydb->real_escape_string($checkVal);

		$query = "SELECT * FROM searchCache WHERE search_val = '$cv'";
		$result = $mydb->query($query)->fetch_assoc();
		if (!isset($result)) {
			echo "not in db, calling api";
			popDatabase($checkVal, json_decode(showRequest($checkVal), true));
			return checkCache($checkVal, $checkType);	
		} else {
			$searchID = $result['search_id'];
			$query = "SELECT showCache.* FROM showSearch JOIN showCache 
				ON showSearch.show_id = showCache.show_id
				WHERE showSearch.search_id = '$searchID'";
	
			$result = $mydb->query($query)->fetch_all();
			return ($result);
		}
	} elseif ($checkType = "lookup") {
		echo "check val is: ".$checkVal;
		echo "and check type is: ". $checkType;
		$sid = $mydb->real_escape_string($checkVal);
		$query = "SELECT showCache.* , genreCache.genre_val 
			FROM showGenre
			JOIN showCache ON showGenre.show_id = showCache.show_id
			JOIN genreCache ON showGenre.genre_id = genreCache.genre_id
			WHERE showGenre.show_id = '$sid'";
		
		$result = $mydb->query($query)->fetch_all();
		$showGenre = array();
		foreach ($result as $show) {
			$showGenre[count($showGenre)] = $show[7];
		}
		$result[0][7] = $showGenre;
		print_r($result[0]);
		return($result[0]);
	}
}

//checkCache("bad", "search");
?>
