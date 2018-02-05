<?php
$servername = "localhost";														//server name
$username = "gasDB";															//login name
$password = "680u43O9fJbNTnMq";														//login password

// Create connection
$mysqli = new mysqli($servername, $username, $password);
// Check connection
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);							//error log
}
$mysqli->select_db("gas");														//selet Database

$strQuery = "SET character_set_results = 'utf8',
	character_set_client = 'utf8',
	character_set_connection = 'utf8',
	character_set_database = 'utf8',
	character_set_server = 'utf8'";
$mysqli->query($strQuery);

 ?>
