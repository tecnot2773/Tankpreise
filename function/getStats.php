<?php
	include_once "dbConnect.php";
	include_once "UTF8Convert.php";

	$lat = "52.9127"; 		//Syke
	$lng = "8.81814";
	$radius = "25";			//25km -- maximum
	$type = "all";	//get all but without best price check


	$http_content = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
			."?lat=$lat"
			."&lng=$lng"
			."&rad=$radius"  // Suchradius in km
			//."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
			."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
			."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key


	$http_content = convert($http_content);
	//print_r($http_content);
	preg_match_all('/"place":"\K(.+?)(?=")/', $http_content, $town);
	preg_match_all('/"brand":"\K(.+?)(?=")/', $http_content, $brand);
	preg_match_all('/"street":"\K(.+?)(?=")/', $http_content, $street);
	preg_match_all('/"name":"\K(.+?)(?=")/', $http_content, $name);
	preg_match_all('/"houseNumber":"\K(.+?)(?=")/', $http_content, $houseNumber);
	preg_match_all('/"e5":\K(.+?)(?=,)/', $http_content, $e5);
	preg_match_all('/"e10":\K(.+?)(?=,)/', $http_content, $e10);
	preg_match_all('/"diesel":\K(.+?)(?=,)/', $http_content, $diesel);
	preg_match_all('/"id":"\K(.+?)(?=",)/', $http_content, $UUID);
	preg_match_all('/"lat":\K(.+?)(?=,)/', $http_content, $lat);
	preg_match_all('/"lng":\K(.+?)(?=,)/', $http_content, $lon);
	preg_match_all('/"brand":"\K(.+?)(?=",)/', $http_content, $brand);

	$count = count($town[1]);
	for ($i = 0; $i < $count; $i++) {
		$town_new = $town[1][$i];
		$brand_new = $brand[1][$i];
		$street_new = $street[1][$i];
		$name_new = $name[1][$i];
		$e5_new = $e5[1][$i];
		$e10_new = $e10[1][$i];
		$diesel_new = $diesel[1][$i];
		$UUID_new = $UUID[1][$i];
		$lat_new = $lat[1][$i];
		$lon_new = $lon[1][$i];
		$brand_new = $brand[1][$i];

		$wtf = "INSERT INTO `gasstation`(`brand`, `name`, `street`, `place`, `lat`, `lon`, `UUID`) VALUES ('$brand_new','$name_new','$street_new','$town_new','$lat_new','$lon_new','$UUID_new')";
		print_r($wtf);
		echo "<br>";
		$checkStation = mysqli_query($conn, "SELECT * FROM gasstation WHERE UUID = '$UUID_new';");
		if(mysqli_num_rows($checkStation) == 0){
			mysqli_query($conn, "INSERT INTO `gasstation`(`brand`,`name`, `street`, `place`, `lat`, `lon`, `UUID`) VALUES ('$brand_new','$name_new','$street_new','$town_new','$lat_new','$lon_new','$UUID_new');");
		}
		$get_stationID = mysqli_query($conn, "SELECT ID FROM gasstation WHERE `UUID` = '$UUID_new'");
		while($data = mysqli_fetch_array($get_stationID)){
			$stationID = $data['ID'];
		}
		mysqli_query($conn,"INSERT INTO `stats`(`diesel`, `E5`, `E10`, `gasStationID`) VALUES ('$diesel_new','$e5_new','$e10_new','$stationID')");
	}
	mysqli_close($conn);
 ?>
