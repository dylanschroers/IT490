<?php
require('functions.php');
require('navbar.php');

if (logged_in(true)) {
	$isMe = true;
}

if (!isset($_POST)) {
        $msg = 'no post msg, fuck off';
        echo json_encode($msg);
        exit(0);
}

$request = $_POST;
$response = "unsupported request type, fuck off";

require('rabbitMQClient.php');
 
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Friends</title>
</head>
<body>
	<h1>My Friends</h1>
	<?php 
	if ($isMe) {
		$servername = "localhost";
		$username = "jkz3";
		$password = "12345";
		$dbname = "Users";
	
		$conn = new mysqli($servername, $username, $password, $dbname);
	
		// connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
	
		
		$uid = 1; // using 1 for now, need to change this so it is the person that is viewing the page
	
		$sql = "SELECT users.username, profile.fname, profile.lname FROM friends
				INNER JOIN users ON friends.friend_id = users.uid
				INNER JOIN profile ON users.uid = profile.uid
				WHERE friends.uid = '$uid' AND friends.are_friends = 1";
	
		$result = $conn->query($sql);
	
		
		if ($result->num_rows > 0) {
			echo "<ul>";
			while($row = $result->fetch_assoc()) {
				echo "<li>" . $row["fname"] . " " . $row["lname"] . " (" . $row["username"] . ")</li>";
			}
			echo "</ul>";
		} else {
			echo "<p>You don't have any friends yet!</p>";
		}
		$conn->close();
	}
	?>
</body>
</html>