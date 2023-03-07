<?php

//this is all for the profile and to grab info from DB


$servername = "localhost";
$username = "root";
$password = "12345";
$dbName = "Users";

$conn = new mysqli($servername, $username, $password, $dbName);


//connection error
if ($conn -> connect_error){
        die("The connection failed: " . $conn->connect_error);}


//query
$query = "SELECT * FROM 'profile';";

$result = $conn ->query($query);

$row = $result->fetch_assoc("Username: " .
                        $row["username"]. " - First Name: " .
                        $row["fname"]. " - Last Name: " .
                        $row["lname"] . "<br>";
        }
}else{
        echo "No Results";
}

$conn ->close();
?>

