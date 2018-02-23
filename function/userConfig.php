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
	if(isset($_GET["id"]) && isset($_GET["delete"])){
		session_start();
		carDelete($_SESSION["userID"], $_GET["id"]);
	}
	function carDelete($userID, $carID){
		include "dbConnect.php";
		$query = "DELETE FROM cars WHERE userID = ? AND ID = ?";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dd", $userID, $carID);
			if($stmt->execute()){
				header("location: ../user/userConfig.php");
			}
		}
		$mysqli->close();
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

		$query = "UPDATE cars SET name = ?, volume = ?, consumption = ?, type = ? WHERE userID = ? AND ID = ?;";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ssssdd", $carName, $volume, $consumption, $type, $userID, $id);
			if($stmt->execute()){
				$status = "Auto wurde erfolgreich bearbeitet";
			}
		}
		$mysqli->close();
		return $status;
	}
	function getUserInfo()
	{
		include "dbConnect.php";
		$sql = "SELECT cityID FROM user WHERE ID = ?";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get hashed_password
			$stmt->bind_param("d", $_SESSION["userID"]);
			$stmt->execute();
			$result = $stmt->get_result();
			while($data = $result->fetch_array()){
				$cityID = $data["cityID"];
			}
		}
		$sql = "SELECT name FROM city WHERE ID = ?";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get hashed_password
			$stmt->bind_param("d", $cityID);
			$stmt->execute();
			$result = $stmt->get_result();
			while($data = $result->fetch_array()){
				$address = $data["name"];
			}
			$_SESSION['address'] = $address;
		}
		$sql = "SELECT type FROM cars WHERE userID = ? ORDER BY ID DESC LIMIT 1";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get hashed_password
			$stmt->bind_param("d", $_SESSION["userID"]);
			$stmt->execute();
			$result = $stmt->get_result();
			if($result->num_rows == 1){
				while($data = $result->fetch_array()){
					$type = $data["type"];
				}
				$_SESSION['type'] = strtolower($type);
			}
		}
		$mysqli->close();
	}
?>
