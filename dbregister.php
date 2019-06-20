<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "username", "password", "dbname");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Escape user inputs for security
$username = mysqli_real_escape_string($link, $_REQUEST['username']);
$fullname = mysqli_real_escape_string($link, $_REQUEST['fullname']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
// attempt insert query execution
$sql = "INSERT INTO t164053_users (username, fullname, password, email) VALUES ('$username', '$fullname', '$password', '$email')";
if(mysqli_query($link, $sql)) {
    $msg = 'Registration complete!';
    echo "<script> window.location.assign('index.php'); </script>";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
