<?php
	function getKoordinates($address, $mysqli){		//get getKoordinates function
		include_once "UTF8Convert.php";
		include_once "curl.php";
		$address = umlauts($address);			//format
		$address = strtolower($address);		//change to lower characters
		$query = "SELECT latitude, longitude FROM city WHERE name = ?;";	//select query
		if ($stmt = $mysqli->prepare($query)) {		//if prepare statement is succsefull
			$stmt->bind_param("s", $address);		//bind parameters
			$stmt->execute();											//exectute query
			$result = $stmt->get_result();				// bind results at $restult
			if(!empty($result)){								//check if empty
				if($result->num_rows >= 1){
					while($data = $result->fetch_array()){	//fetch results
						$latitude = $data["latitude"];
						$longitude = $data["longitude"];
						$cityID = null;
						$error = "OK";
					}
					$return = array($latitude, $longitude, $cityID);			//return needed values
				}
				$stmt->close();					//close prepare statement
			}
		}
		if(empty($latitude) && empty($longitude)){		//if no koordinates are given
			$url = 'https://maps.googleapis.com/maps/api/geocode/json'."?address=$address&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";		//get koordinates via googleAPI
			$json = curl_get_contents($url);	//get contents
			$decoded = json_decode($json);		//decode json
			if($decoded->status == "OK"){
				if(isset($decoded->results[0]->address_components[2]->long_name)){$land = $decoded->results[0]->address_components[2]->long_name;}	//check if address is in Germany
				if(isset($decoded->results[0]->address_components[3]->long_name) && $land != "Germany"){$land = $decoded->results[0]->address_components[3]->long_name;}
				if(isset($decoded->results[0]->address_components[4]->long_name) && $land != "Germany"){$land = $decoded->results[0]->address_components[4]->long_name;}
				if($land == "Germany"){
					$longitude = $decoded->results[0]->geometry->location->lng;		//get longitude from array
					$latitude = $decoded->results[0]->geometry->location->lat;		//get latitude from array
					if(isset($longitude)){		//when longitude is set
						$query = "INSERT INTO `city`(`name`, `latitude`, `longitude`) VALUES (?, ?, ?);";		// query
						if ($stmt = $mysqli->prepare($query)) {			//prepare insert
							$stmt->bind_param("sdd", $address, $latitude, $longitude);			//bind parameters
							$stmt->execute();				//execute query
							$cityID = $mysqli->insert_id;		//get id from last insert
							$stmt->close();				//close prepare statment
							$return = array($latitude, $longitude, $cityID);			//return needed values
							$error = "OK";
						}
					}
				}
				else{
					$error = "Addresse ist nicht in Deutschland";
					$return = "false";
				}
			}
			else{
				$error = $decoded->status;
				$return = "false";
			}
		}
		return array($error, $return);
	}
?>
