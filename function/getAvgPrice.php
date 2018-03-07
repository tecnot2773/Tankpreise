<?php
	include "dbConnect.php";
	$query = "SELECT avg(?) AS ? FROM stats WHERE MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? AND HOUR(timestamp) = ?;";
	$query1 = "INSERT INTO avgPriceDaily (`price`, `type`) VALUES ('?', '?', '?')";
	if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
		if($stmt1 = $mysqli->prepare($query1)) {
			$stmt->bind_param("ssssss", $type, $type, $month, $day, $year, $hour);		//bind parameters
			$stmt1->bind_param("sss", $avgPrice, $type);

			$type = "diesel";
			$day = date("d", strtotime("last day"));		//day from last monday
			$month = date("m", strtotime("last day"));	//month from last monday
			$year = date("Y", strtotime("last day"));	//year from last monday
			for($i = 0; $i < 24; $i++){
				$hour = $i;
				//echo "SELECT avg(diesel) AS diesel FROM stats WHERE MONTH(timestamp) = $month AND DAY(timestamp) = $day AND YEAR(timestamp) = $year AND HOUR(timestamp) = $hour;";
				$stmt->execute();			//execute statement
				$result = $stmt->get_result();		//save result
				 while($data = $result->fetch_array()){
					 $avgPrice = $data[$type];
					 echo $avgPrice;
				}
				$stmt1->execute();
			}
			$type = "e5";
			for($i = 0; $i < 24; $i++){
				$hour = $i;
				//echo "SELECT avg(diesel) AS diesel FROM stats WHERE MONTH(timestamp) = $month AND DAY(timestamp) = $day AND YEAR(timestamp) = $year AND HOUR(timestamp) = $hour;";
				$stmt->execute();			//execute statement
				$result = $stmt->get_result();		//save result
				 while($data = $result->fetch_array()){
					$avgPrice = $data[$type];
				}
				$stmt1->execute();
			}
			$type = "e10";
			for($i = 0; $i < 24; $i++){
				$hour = $i;
				//echo "SELECT avg(diesel) AS diesel FROM stats WHERE MONTH(timestamp) = $month AND DAY(timestamp) = $day AND YEAR(timestamp) = $year AND HOUR(timestamp) = $hour;";
				$stmt->execute();			//execute statement
				$result = $stmt->get_result();		//save result
				 while($data = $result->fetch_array()){
					 $avgPrice = $data[$type];
				}
				$stmt1->execute();
			}
			$stmt1->close();
		}
		$stmt->close();
	}
	$mysqli->close();
	echo "INSERT INTO avgPriceDaily (`price`, `type`) VALUES ($avgPrice, $type)";

 ?>
