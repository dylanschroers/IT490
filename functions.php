<?php

// Initial function (se)
function se($v, $k = null, $default = "", $isEcho = true)
{
    if (is_array($v) && isset($k) && isset($v[$k])) {
        $returnValue = $v[$k];
    } else if (is_object($v) && isset($k) && isset($v->$k)) {
        $returnValue = $v->$k;
    } else {
        $returnValue = $v;
        if (is_array($returnValue) || is_object($returnValue)) {
            $returnValue = $default;
        }
    }
    if (!isset($returnValue)) {
        $returnValue = $default;
    }
    if ($isEcho) {
        //https://www.php.net/manual/en/function.htmlspecialchars.php
        echo htmlspecialchars($returnValue, ENT_QUOTES);
    } else {
        //https://www.php.net/manual/en/function.htmlspecialchars.php
        return htmlspecialchars($returnValue, ENT_QUOTES);
    }
}
// User helpers
function logged_in($redirect = false, $destination = "index.php")
{
    $isLoggedIn = isset($_SESSION["user"]);
    if ($redirect && !$isLoggedIn) {
        echo 'Not logged in!';
        die(header("Location: $destination"));
    }
    return $isLoggedIn; //se($_SESSION, "user", false, false);
}

function get_username()
{
    if (logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "username", "", false);
    }
    return "";
}

function get_email()
{
    if (logged_in()) { //we need to check for login first because "user" key may not exist
        return se($_SESSION["user"], "email", "", false);
    }
    return "";
}

function reset_session() {
    session_unset();
    session_destroy();
}

function redirect($path)
{ //header headache
    //https://www.php.net/manual/en/function.headers-sent.php#90160
    /*headers are sent at the end of script execution otherwise they are sent when the buffer reaches it's limit and emptied */
    if (!headers_sent()) {
        //php redirect
        die(header("Location: " . get_url($path)));
    }
    //javascript redirect
    echo "<script>window.location.href='" . get_url($path) . "';</script>";
    //metadata redirect (runs if javascript is disabled)
    echo "<noscript><meta http-equiv=\"refresh\" content=\"0;url=" . get_url($path) . "\"/></noscript>";
    die();
}

function get_url($dest)
{
    global $BASE_PATH;
    if (str_starts_with($dest, "/")) {
        //handle absolute path
        return $dest;
    }
    //handle relative path
    return $BASE_PATH . $dest;
}

?>