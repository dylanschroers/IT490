<?php

// User Helpers
function logged_in($redirect = false, $destination = "login.php")
{
    $isLoggedIn = isset($_SESSION["user"]);
    if ($redirect && !$isLoggedIn) {
        echo 'Not logged in!';
        die(header("Location: $destination"));
    }
    return $isLoggedIn; //se($_SESSION, "user", false, false);
}

function reset_session() {
    session_unset();
    session_destroy();
}

?>