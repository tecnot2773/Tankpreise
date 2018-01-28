<?php
	include_once "../function/dbConnect.php";
	include_once "statPrint.php";
	$UUID = $_GET["id"];
	$id = mysqli_fetch_array(mysqli_query($conn, "SELECT ID FROM gasstation WHERE UUID = '$UUID';"))['ID'];

	echo "UUID: " . $UUID . "<br>Diesel<br>";
	statPrint("$id","diesel");
	echo "E5<br>";
	statPrint("$id","E5");
	echo "E10<br>";
	statPrint("$id","E10");
 ?>
