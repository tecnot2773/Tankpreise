<?php
	// This File is executed in Linux Crontab to save average Prices into a seperate Database Table. This is to lower the request time when average Prices are requested
	include "dbConnect.php";
	$query = "SELECT TRUNCATE(avg(diesel),4) avg FROM stats WHERE MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? AND HOUR(timestamp) = ?;"; // Select avg values from diesel
	$query1 = "INSERT INTO avgPriceDaily (`timestamp`, `avgPrice`, `type`) VALUES (?,?,?)";		// Insert into average Data into avgPriceDaily
	if ($stmt1 = $mysqli->prepare($query1)) {		//prepare statement to get stats
		if($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ssss", $month, $day, $year, $hour);		//bind parameters
			$stmt1->bind_param("sss", $timestamp, $avgPrice, $type);	//bind parameters to second query

			$type = "diesel";
			$day = date("d", strtotime("last day"));
			$month = date("m", strtotime("last day"));
			$year = date("Y", strtotime("last day"));
			for($i = 0; $i < 24; $i++){
				$hour = $i;
				$timestamp = $year ."-". $month ."-". $day . " " . $hour . ":00:00";
				$stmt->execute();			//execute statement
				$result = $stmt->get_result();		//save result
				 while($data = $result->fetch_array()){
					 print_r($data);				//debug
					 $avgPrice = $data["avg"];		// in avgPrice
					 $stmt1->execute();
				}
			}
		}
		$query = "SELECT TRUNCATE(avg(e5),4) avg FROM stats WHERE MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? AND HOUR(timestamp) = ?;";	// Select avg values from e5
		if($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ssss", $month, $day, $year, $hour);		//bind parameters
			$type = "e5";
			for($i = 0; $i < 24; $i++){
				$hour = $i;
				$timestamp = $year ."-". $month ."-". $day . " " . $hour . ":00:00";
				$stmt->execute();			//execute statement
				$result = $stmt->get_result();		//save result
				 while($data = $result->fetch_array()){
					$avgPrice = $data["avg"];
				}
				$stmt1->execute();
			}
		}
		$query = "SELECT TRUNCATE(avg(e10),4) avg FROM stats WHERE MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? AND HOUR(timestamp) = ?;";	//selet avg values from e10
		if($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ssss", $month, $day, $year, $hour);		//bind parameters
			$type = "e10";
			for($i = 0; $i < 24; $i++){
				$hour = $i;
				$timestamp = $year ."-". $month ."-". $day . " " . $hour . ":00:00";
				$stmt->execute();			//execute statement
				$result = $stmt->get_result();		//save result
				 while($data = $result->fetch_array()){
					 $avgPrice = $data["avg"];
				}
				$stmt1->execute();
			}
			$stmt->close();
		}
		$stmt1->close();
	}
	$mysqli->close();

 ?>
