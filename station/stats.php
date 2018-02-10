<?php
	include_once "../function/statPrint.php";
	$id = $_GET["id"];
	echo "<h3>Diesel</h3>";
	statPrint("$id","diesel");
	echo "<h3>E5</h3>";
	statPrint("$id","E5");
	echo "<h3>E10</h3>";
	statPrint("$id","E10");
 ?>
