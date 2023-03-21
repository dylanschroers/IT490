


<?php
// require('functions.php');
require('header.php');

require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


//validates session
 

if (logged_in(true)) {



if (!isset($_POST)) {
        $msg = 'no post msg, fuck off';
        echo json_encode($msg);
        exit(0);
}

$request = $_POST;
$response = "unsupported request type, fuck off";

require('rabbitMQClient.php');

//this is all for the profile and to grab info from DB


$servername = "localhost";
$username = "jkz3";
$password = "12345";
$dbName = "Users";
if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

$conn = mysqli_connect($servername, $username, $password, $dbName);


//connection error
if (!$conn){
        die("The connection failed: " . mysqli_connect_error());}


//query
$query = "SELECT * FROM profile";

$result = mysqli_query($conn, $query);
/*
echo "<table>";
echo"<tr><th>Username</th><th>First Name</th><th>Last Name</th></tr>";
$row = mysqli_fetch_assoc($result){
	echo "<tr><td>" .
       		$row["username"] . "</td><td>" .
	       	$row["fname"]. "</td><td>" .
		$row["lname"] . "</td></tr>";
}
echo "</table>";
}
 */


mysqli_close($conn);

}
else{
	redirect('login.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
</head>
<body>
	<h1>Profile</h1>
	<table>
	<tr><tr>
		<th>Username</th>
		<th>First Name</th>
                <th>Last Name</th>
		</tr>
		   <?php $row = mysqli_fetch_assoc($result);{?>
		<tr>
  		   <td><?php echo $row['username']; ?></td>
		   <td><?php echo $row['fname']; ?></td>
                   <td><?php echo $row['lname']; ?></td>
		</tr> <?php } ?>
	</table>
</body>
</html>


