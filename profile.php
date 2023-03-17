	


<?php

//this is all for the profile and to grab info from DB


$servername = "localhost";
$username = "root";
$password = "12345";
$dbName = "Users";

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
		   <?php $row = mysqli_fetch_assoc($result){?>
		<tr>
  		   <td><?php echo $row['username']; ?></td>
		   <td><?php echo $row['fname']; ?></td>
                   <td><?php echo $row['lname']; ?></td>
		</tr> <?php} ?>
	</table>
</body>
</html>


