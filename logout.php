<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    unset($_SESSION["logged-in"]);
    echo 'logged out';
}
?>
