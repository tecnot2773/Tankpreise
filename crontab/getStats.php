<?php
	include_once "../function/dbConnect.php";		//new mysqli
	include_once "../function/getGasStation.php";

	$sort = "stats";
	$lat = "52.9127"; 		//Syke
	$lng = "8.81814";
	$radius = "25";
	$decoded = getStations25($lat, $lng, $radius);		//function calls
	$UUID = getUUID($decoded, $sort);
	$place = getPlace($decoded, $sort);
	$brand = getBrand($decoded, $sort);
	$street = getStreet($decoded, $sort);
	$name = getName($decoded, $sort);
	$houseNumber = getHousenumber($decoded, $sort);
	$e5 = getE5($decoded);
	$e10 = getE10($decoded);
	$diesel = getDiesel($decoded);
	$lat = getLat($decoded);
	$lon = getLon($decoded);

	$count = count($UUID);																														//value in for loop

	$stmtgetStation = $mysqli->prepare("SELECT * FROM gasstation WHERE UUID = ?;");				//prepare statement to check if the Station is in the DB
	$stmtgetStation->bind_param("s", $UUID_new);			//bind parameter

	$queryStation = "INSERT INTO `gasstation`(`brand`,`name`, `street`, `place`, `lat`, `lon`, `UUID`) VALUES (?, ?, ?, ?, ?, ?, ?);";
	$stmtStation = $mysqli->prepare($queryStation);																				//prepare statement to insert missing station
	$stmtStation->bind_param("ssssdds", $brand_new, $name_new, $street_new, $place_new, $lat_new, $lon_new, $UUID_new);	//bind parameter

	$stmtgetID = $mysqli->prepare("SELECT ID FROM gasstation WHERE `UUID` = ?");					//prepare statement to search for station in local DB
	$stmtgetID->bind_param("s", $UUID_new);						//bind parameter

	$queryStats = "INSERT INTO `stats`(`diesel`, `E5`, `E10`, `gasStationID`) VALUES (?, ?, ?, ?)";
	$stmtStats = $mysqli->prepare($queryStats);																						//prepare statement to insert current stats
	$stmtStats->bind_param("sssd", $diesel_new, $e5_new, $e10_new, $stationID);		//bind parameter

	for ($i = 0; $i < $count; $i++) {
		$place_new = $place[$i];
		$brand_new = $brand[$i];
		$street_new = $street[$i];
		$name_new = $name[$i];
		$e5_new = $e5[$i];
		$e10_new = $e10[$i];
		$diesel_new = $diesel[$i];
		$UUID_new = $UUID[$i];
		$lat_new = $lat[$i];
		$lon_new = $lon[$i];
		$brand_new = $brand[$i];


		$stmtgetStation->execute();												//execute prepared statement
		$result = $stmtgetStation->get_result();					//write result in $result
		if($result->num_rows == 0){												//if num_rows == 0 means the Station is not in the local DB
			$stmtStation->execute();												//execute prepared statement to insert missing Station
		}
		$result->free();																	//free result

		$stmtgetID->execute();														//execute prepared statement
		$result = $stmtgetID->get_result();								//write result in $result
		while($data = $result->fetch_array()){						//fetch array
			$stationID = $data['ID'];												//write ID in $stationID
		}
		$result->free();																	//free result
		$stmtStats->execute();														//insert stats into DB

	}
	$stmtStats->close();		//close statements
	$stmtgetID->close();
	$stmtStation->close();
	$stmtgetStation->close();
	$mysqli->close();																		//close DB connection
 ?>
