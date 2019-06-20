<?php
/* Database connection settings */
$host = '';
$user = '';
$pass = '';
$db = '';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
