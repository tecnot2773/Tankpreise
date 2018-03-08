<?php
	function changePlace(){				//new changePlace
		include "dbConnect.php";			//new mysqli
		//include_once "UTF8Convert.php";
		include_once "getKoordinates.php";		//include getKoordinates
		$address = $mysqli->real_escape_string($_POST["text-place"]);		//save and escape text-place
		$address = preg_replace('/\s+/', '+', $address);
		//$address = umlauts($address);
		$address = strtolower($address);			//make address to lower characters

		$query = "SELECT ID FROM city WHERE name = ?";		//query to get ID from city
		if ($stmt = $mysqli->prepare($query)) {			//prepare statement
			$stmt->bind_param("s", $address);			//bind parameter
			$stmt->execute();							//execute statement
			$result = $stmt->get_result();				//save result
			if(!empty($result)){					//if result is not empty
				if($result->num_rows >= 1){
					while($data = $result->fetch_array()){		//fetch array
						$cityID = $data["ID"];			//save id in cityID
					}
					$error0 = "false";
				}
				else{
					list($error, $return) = getKoordinates($address, $mysqli); 		//getKoordinates from city
					$cityID = $return[2];
					if($error == "OK"){
						$cityID = $cityID[2];
						$error0 = "false";
					}
					else{
						$error0 =  "true";
						if($error == "OVER_QUERY_LIMIT"){
							$status = "Zu viele Anfragen bei der Google API, bitte laden Sie die Seite neu.";
						}
						if($error == "ZERO_RESULTS"){
							$status = "Zu Ihrer Anfrage konnte kein Ort gefunden werden.";
						}
					}
				}
			}
			$stmt->close();											//close statement
		}
		if($error0 == "false"){
			$query = "SELECT * FROM userPlace WHERE userID = ?;";		//query to select userplace
			if ($stmt = $mysqli->prepare($query)) {						//prepare statement
				$stmt->bind_param("d", $userID);				//bind parameter
				$userID = $_SESSION['userID'];
				$stmt->execute();
				$result = $stmt->get_result();				//save result
				if(!empty($result)){					//if result is not empty
					if($result->num_rows == 1){
						$query = "UPDATE userPlace SET cityID = ? WHERE userID = ?;";		//query to update cityID
						if ($stmt = $mysqli->prepare($query)) {						//prepare statement
							$stmt->bind_param("dd", $cityID, $userID);				//bind parameter
							$userID = $_SESSION['userID'];
							$stmt->execute();
							getUserInfo();
							$status = "Wohnort erfolgreich geändert";
						}
					}
					else{
						$query = "INSERT INTO `userPlace`(`userID`, `cityID`) VALUES (?, ?);";		//query to update cityID
						if ($stmt = $mysqli->prepare($query)) {						//prepare statement
							$stmt->bind_param("dd", $userID, $cityID);				//bind parameter
							$userID = $_SESSION['userID'];
							$stmt->execute();
							getUserInfo();
							$status = "Wohnort erfolgrech angelegt.";			//staus if Wohnort is changed
							$stmt->close();					//close statement
						}
					}
				}
				$mysqli->close();				//close mysqli
			}
		}

		return $status;					//return status
	}
	function addCar(){
		include "dbConnect.php";
		$carName = $mysqli->real_escape_string($_POST["text-carname"]);				//save and escape text-carname
		$type = $mysqli->real_escape_string($_POST["text-type"]);				//save and escape text-type
		$volume = $mysqli->real_escape_string($_POST["text-volume"]);				//save and escape text-volume
		$consumption = $mysqli->real_escape_string($_POST["text-consumption"]);				//save and escape text-consumption
		$userID = $_SESSION["userID"];
		if(preg_match("^[0-9]{1,3}([,.][0-9]{1,3})?$^", $volume) && preg_match("^[0-9]{1,3}([,.][0-9]{1,3})?$^", $consumption)){

			if($type != "Diesel" && $type != "E5" && $type != "E10"){
				$type = "Diesel";
			}													//save userID

			$query = "INSERT INTO `cars`(`userID`, `name`, `volume`, `consumption`, `type`) VALUES (?, ?, ?, ?, ?)";		//query to insert new car
			if ($stmt = $mysqli->prepare($query)) {
				$stmt->bind_param("dssss", $userID, $carName, $volume, $consumption, $type);								//bind parameters
				if ($stmt->execute()){
					$status = "Neues Auto erfolgreich hinzugefügt.";							//status of car is inserted
				}
			}
			$stmt->close();				//close statement
			$mysqli->close();			//close mysqli
		}
		else{
			$status = "Bitte geben Sie für das Volumen und den Verbauch nur Zahlen ein";
		}
		return $status;				//return status
	}
	function carTable(){
		include "dbConnect.php";			//new mysqli
		$userID = $_SESSION["userID"];

		$query = "SELECT ID, name, volume, consumption, type FROM cars WHERE userID = ?";		//query to get values from cars
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("d", $userID);
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
		$stmt->close();					//close statement
		$mysqli->close();				//close mysqli
	}
	if(isset($_GET["id"]) && isset($_GET["delete"])){		//if id and delete are set
		if (session_status() == PHP_SESSION_NONE) {
    		session_start();
		}									//start session
		carDelete($_SESSION["userID"], $_GET["id"]);		// call function with parameters
	}
	function carDelete($userID, $carID){					//carDelete function
		include "dbConnect.php";				//new mysqli
		$query = "DELETE FROM cars WHERE userID = ? AND ID = ?"; 		//query to delete car
		echo "DELETE FROM cars WHERE userID = $userID AND ID = $carID";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dd", $userID, $carID);
			if($stmt->execute()){
				header("location: ../user/userConfig.php");				//refer to userConfig.php
			}
			$stmt->close();					//close statement
		}
		$mysqli->close();				//close mysqli
	}
	function editCar()
	{
		include "dbConnect.php";
		$carName = $mysqli->real_escape_string($_POST["text-carname"]);
		$type = $mysqli->real_escape_string($_POST["text-type"]);
		$volume = $mysqli->real_escape_string($_POST["text-volume"]);
		$consumption = $mysqli->real_escape_string($_POST["text-consumption"]);
		$id = $mysqli->real_escape_string($_POST["box-edit"]);
		$userID = $_SESSION["userID"];

		if(preg_match("^[0-9]{1,3}([,.][0-9]{1,3})?$^", $volume) && preg_match("^[0-9]{1,3}([,.][0-9]{1,3})?$^", $consumption)){
			if($type != "Diesel" && $type != "E5" && $type != "E10"){
				$type = "Diesel";
			}


			$query = "UPDATE cars SET name = ?, volume = ?, consumption = ?, type = ? WHERE userID = ? AND ID = ?;";		//query to update cars
			if ($stmt = $mysqli->prepare($query)) {
				$stmt->bind_param("ssssdd", $carName, $volume, $consumption, $type, $userID, $id);
				if($stmt->execute()){
					$status = "Auto wurde erfolgreich bearbeitet";				//status if car is edited
				}
			}
			$stmt->close();				//close statement
			$mysqli->close();			//close mysqli
			return $status;				//return status
		}
	}
	function getUserInfo()
	{
		include "dbConnect.php";
		$sql = "SELECT cityID FROM userPlace WHERE userID = ?";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get cityID
			$stmt->bind_param("d", $_SESSION["userID"]);
			$stmt->execute();
			$result = $stmt->get_result();
			while($data = $result->fetch_array()){
				$cityID = $data["cityID"];
			}
			$stmt->close();										//close statement
		}
		if(!empty($result)){					//if result is not empty
			if($result->num_rows == 1){
				$sql = "SELECT name FROM city WHERE ID = ?";
				if($stmt = $mysqli->prepare($sql)){																		//prepare to get city name
					$stmt->bind_param("d", $cityID);
					$stmt->execute();
					$result = $stmt->get_result();
					if($result->num_rows >= 1){
						while($data = $result->fetch_array()){
							$address = $data["name"];
						}
						$_SESSION['address'] = $address;							//save address in session
					}
					$stmt->close();										//close statement
				}
			}
			else{
				unset($_SESSION['address']);
			}
		}
		$sql = "SELECT type FROM cars WHERE userID = ? ORDER BY ID DESC LIMIT 1";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get car type
			$stmt->bind_param("d", $_SESSION["userID"]);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows == 1){
				while($data = $result->fetch_array()){
					$type = $data["type"];
				}
				$_SESSION['type'] = strtolower($type);						//save car type in Session
			}
		}
		$stmt->close();												//close statement
		$mysqli->close();												//close mysqli
		return $address;
	}
	function getLowestPrice($address)
	{
		include "dbConnect.php";
		include_once "getStation.php";
		$sql = "SELECT latitude, longitude FROM city WHERE name = ?";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get car type
			$stmt->bind_param("s", $_SESSION['address']);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows == 1){
				while($data = $result->fetch_array()){
					$lat = $data["latitude"];
					$lon = $data["longitude"];
				}
			}
		}
		$radius = "5";
		$content = getStations25($lat, $lon, $radius);
		$UUID = getUUID($content, "");
		$name = getName($content, "");
		$e5 = getE5($content);
		$e10 = getE10($content);
		$diesel = getDiesel($content);
		$count = count($UUID);
		$lowestE10 = "1.999";
		for($i = 0; $i < $count; $i++){
			if($e10[$i] != ""){
				if($e10[$i] < $lowestE10){
					$lowestE10 = $e10[$i];
					$saveE10 = $i;
				}
			}
		}
		$lowestE5 = "1.999";
		for($i = 0; $i < $count; $i++){
			if($e5[$i] != ""){
				if($e5[$i] < $lowestE5){
					$lowestE5 = $e5[$i];
					$saveE5 = $i;
				}
			}
		}
		$lowestDiesel = "1.999";
		for($i = 0; $i < $count; $i++){
			if($diesel[$i] != ""){
				if($diesel[$i] < $lowestDiesel){
					$lowestDiesel = $diesel[$i];
					$saveDiesel = $i;
				}
			}
		}
		$lowest = array('e5Price'=>$lowestE5, 'e5ID'=>$UUID[$saveE5], 'e5Name'=>$name[$saveE5], 'e10Price'=>$lowestE10, 'e10ID'=>$UUID[$saveE10], 'e10Name'=>$name[$saveE10], 'dieselPrice'=>$lowestDiesel, 'dieselID'=>$UUID[$saveDiesel], 'dieselName'=>$name[$saveDiesel]);
		$mysqli->close();
		return $lowest;
	}
?>
