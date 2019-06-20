<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "username", "password", "dbname");
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
// Escape user inputs for security
$username = $_SESSION['uname'];
$title = mysqli_real_escape_string($link, $_REQUEST['title']);
$content = mysqli_real_escape_string($link, $_REQUEST['content']);
$subreddit = mysqli_real_escape_string($link, $_REQUEST['subreddit']);
$posttype = '1'; // mysqli_real_escape_string($link, $_REQUEST['email']);
// attempt insert query execution
$sql = "INSERT INTO t164053_news (username, news, type, subreddit, title) VALUES ($username, $content, $posttype, $subreddit, $title)";
if(mysqli_query($link, $sql)) {
    $msg = 'Post submitted successfully!';
    echo "<script> window.location.assign('index.php'); </script>";
} else {
    echo $_SESSION['uname'];
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
mysqli_close($link);
?>
