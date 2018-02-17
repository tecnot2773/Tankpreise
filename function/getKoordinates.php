<?php
	function getKoordinates($address, $mysqli){
		include_once "UTF8Convert.php";
		$address = umlauts($address);
		$address = strtolower($address);
		$query = "SELECT latitude, longitude FROM city WHERE name = ?;";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("s", $address);
			$stmt->execute();
			$result = $stmt->get_result();
			if(!empty($result)){
				if($result->num_rows >= 1){
					while($data = $result->fetch_array()){
						$latitude[1] = $data["latitude"];
						$longitude[1] = $data["longitude"];
					}
				}
				$stmt->close();
			}
		}
		if(empty($latitude) && empty($longitude)){
			$url = 'https://maps.googleapis.com/maps/api/geocode/json'."?address=$address&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";
			$json = file_get_contents($url);
			preg_match('/"location" : {\n\s*"lat" : (.+?)(?=,)/' , $json, $latitude);
			preg_match('/"location" : {\n\s*"lat" : \d*.\d*,\n\s*"lng" : (.+?)(?=\n)/', $json, $longitude);
			if(isset($longitude[1])){
				$query = "INSERT INTO `city`(`name`, `latitude`, `longitude`) VALUES (?, ?, ?);";
				if ($stmt = $mysqli->prepare($query)) {
					$stmt->bind_param("sdd", $address, $latitude[1], $longitude[1]);
					$stmt->execute();
					$cityID = $mysqli->insert_id;
					$stmt->close();
				}
			}
		}
		return array($latitude[1], $longitude[1], $cityID);
	}
?>
