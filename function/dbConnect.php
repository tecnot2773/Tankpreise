<?php
$servername = "localhost";														//server name
$username = "gasDB";															//login name
$password = "RChwl8DMfgeDi3CR";														//login password

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);							//error log
}
$conn->select_db("gas");														//selet Database

$strQuery = "SET character_set_results = 'utf8',
	character_set_client = 'utf8',
	character_set_connection = 'utf8',
	character_set_database = 'utf8',
	character_set_server = 'utf8'";
$conn->query($strQuery);

 ?>
