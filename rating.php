<?php

// Connect to the MySQL database
$host = 'localhost';
$user = 'username';
$password = 'password';
$dbname = 'tv_shows';
$mysqli = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
    exit();
}

// Check if the user has submitted a rating
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user's rating from the form
    $show_id = $_POST['show_id'];
    $rating = $_POST['rating'];

    // Insert the rating into the database
    $query = "INSERT INTO ratings (show_id, rating) VALUES ('$show_id', '$rating')";
    if (!$mysqli->query($query)) {
        echo 'Error inserting rating: ' . $mysqli->error;
    } else {
        echo 'Rating submitted successfully!';
    }
}

// Get a list of TV shows from the TVMaze API
$api_url = 'http://api.tvmaze.com/shows';
$shows_json = file_get_contents($api_url);
$shows = json_decode($shows_json);
?>

<!-- Display a form to allow the user to rate a TV show -->
<html>
<h1>Rate a TV Show</h1>
<form method="post" action="">
  <label for="show_id">Select a TV show:</label>
  <select name="show_id" id="show_id">
    <?php foreach ($shows as $show) { ?>
      <option value="<?php echo $show->id; ?>"><?php echo $show->name; ?></option>
    <?php } ?>
  </select><br>
  <label for="rating">Rate the show (1-5 stars):</label>
  <input type="number" name="rating" id="rating" min="1" max="5"><br>
  <input type="submit" value="Submit Rating">
</form>
</html>

<?php

// Close the MySQL database connection
$mysqli->close();

?>