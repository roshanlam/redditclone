<?php
/* Database connection settings */
$host = '';
$user = '';
$pass = '';
$db = '';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} 
echo "Connected successfully";
?>
