<?php
	function changePlace(){
		include "dbConnect.php";
		//include_once "UTF8Convert.php";
		include_once "getKoordinates.php";
		$address = $mysqli->real_escape_string($_POST["text-place"]);
		//$address = umlauts($address);
		$address = strtolower($address);

		$query = "SELECT ID FROM city WHERE name = ?";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("s", $address);
			$stmt->execute();
			$result = $stmt->get_result();
			if(!empty($result)){
				if($result->num_rows >= 1){
					while($data = $result->fetch_array()){
						$cityID = $data["ID"];
					}
				}
				else{
					$cityID = getKoordinates($address, $mysqli);
					$cityID = $cityID[2];
				}
			}
		}
		$query = "UPDATE user SET cityID = ? WHERE ID = ?;";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dd", $cityID, $userID);
			$userID = $_SESSION['userID'];
			$stmt->execute();
			$status = "Wohnort erfolgrech geändert.";
		}
		$mysqli->close();
		return $status;
	}
	function addCar(){
		include "dbConnect.php";
		$carName = $mysqli->real_escape_string($_POST["text-carname"]);
		$type = $mysqli->real_escape_string($_POST["text-type"]);
		$volume = $mysqli->real_escape_string($_POST["text-volume"]);
		$consumption = $mysqli->real_escape_string($_POST["text-consumption"]);
		$userID = $_SESSION["userID"];

		$query = "INSERT INTO `cars`(`userID`, `name`, `volume`, `consumption`, `type`) VALUES (?, ?, ?, ?, ?)";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dssss", $userID, $carName, $volume, $consumption, $type);
			if ($stmt->execute()){
				$status = "Neues Auto erfolgreich hinzugefügt.";
			}
		}
		$mysqli->close();
		return $status;
	}
	function carTable(){
		include "dbConnect.php";
		$userID = $_SESSION["userID"];

		$query = "SELECT ID, name, volume, consumption, type FROM cars WHERE userID = ?";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("d", $userID);
			$stmt->execute();
			$result = $stmt->get_result();
			return $result;
		}
		$mysqli->close();
	}



?>
