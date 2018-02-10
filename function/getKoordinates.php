<?php
	//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(isset($_GET["address"]) && isset($_GET["radius"]) && isset($_GET["type"])){
		include_once "dbConnect.php";

		$address = $mysqli->real_escape_string($_GET["address"]);
		$radius = $mysqli->real_escape_string($_GET["radius"]);
		$type = $mysqli->real_escape_string($_GET["type"]);

		if($radius > 25){
			$radius = 25;
		}
		if($type == "Diesel"){
			$type = "diesel";
		}
		if($type == "E5"){
			$type = "e5";
		}
		if($type == "E10"){
			$type = "e10";
		}
		if($type != "diesel" && $type != "e5" && $type != "e10"){
			$type = "diesel";
		}

		$query = "SELECT latitude, longitude FROM city WHERE name = ?;";
		if ($stmt = $mysqli->prepare($query)) {
			$address = strtolower($address);
			$stmt->bind_param("s", $address);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows > 0){
				while($data = $result->fetch_array()){
					$latitude[1] = $data["latitude"];
					$longitude[1] = $data["longitude"];
				}
			}
			$stmt->close();
		}
		if(empty($latitude) && empty($longitude)){
			$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json'
			    ."?address=$address"   // adress
			    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key

			preg_match('/"location" : {\n\s*"lat" : (.+?)(?=,)/' , $json, $latitude);
			preg_match('/"location" : {\n\s*"lat" : \d*.\d*,\n\s*"lng" : (.+?)(?=\n)/', $json, $longitude);
			if(isset($longitude[1])){
				$query = "INSERT INTO `city`(`name`, `latitude`, `longitude`) VALUES (?, ?, ?);";
				if ($stmt = $mysqli->prepare($query)) {
					$stmt->bind_param("sdd", $address, $latitude[1], $longitude[1]);
					$stmt->execute();
					$stmt->close();
				}
			}
		}

		if(isset($longitude[1])){
			include_once "getPrice.php";
			getPrice($longitude[1], $latitude[1], $radius, $type);

			$town_new = preg_replace('/(?=\s)(.+?)(?=\w)/', '+', $town[1][$move]);
			$street_new = preg_replace('/(?=\s)(.+?)(?=\w)/', '+', $street[1][$move]);
			$number_new = preg_replace('/(?=\s)(.+?)(?=\w)/', '+', $houseNumber[1][$move]);
		}else{
			echo "GoogleAPI overflow <br> Please reload the Page";
		}
		$mysqli->close();
	}
?>
