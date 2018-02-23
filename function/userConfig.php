<?php
	function changePlace(){				//new changePlace
		include "dbConnect.php";			//new mysqli
		//include_once "UTF8Convert.php";
		include_once "getKoordinates.php";		//include getKoordinates
		$address = $mysqli->real_escape_string($_POST["text-place"]);		//save and escape text-place
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
				}
				else{
					$cityID = getKoordinates($address, $mysqli); 		//getKoordinates from city
					$cityID = $cityID[2];
				}
			}
		}
		$stmt->close();												//close statement
		$query = "UPDATE user SET cityID = ? WHERE ID = ?;";		//query to update cityID
		if ($stmt = $mysqli->prepare($query)) {						//prepare statement
			$stmt->bind_param("dd", $cityID, $userID);				//bind parameter
			$userID = $_SESSION['userID'];
			$stmt->execute();
			getUserInfo();
			$status = "Wohnort erfolgrech geändert.";			//staus if Wohnort is changed
		}
		$stmt->close();					//close statement
		$mysqli->close();				//close mysqli

		return $status;					//return status
	}
	function addCar(){
		include "dbConnect.php";
		$carName = $mysqli->real_escape_string($_POST["text-carname"]);				//save and escape text-carname
		$type = $mysqli->real_escape_string($_POST["text-type"]);				//save and escape text-type
		$volume = $mysqli->real_escape_string($_POST["text-volume"]);				//save and escape text-volume
		$consumption = $mysqli->real_escape_string($_POST["text-consumption"]);				//save and escape text-consumption
		$userID = $_SESSION["userID"];													//save userID

		$query = "INSERT INTO `cars`(`userID`, `name`, `volume`, `consumption`, `type`) VALUES (?, ?, ?, ?, ?)";		//query to insert new car
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dssss", $userID, $carName, $volume, $consumption, $type);								//bind parameters
			if ($stmt->execute()){
				$status = "Neues Auto erfolgreich hinzugefügt.";							//status of car is inserted
			}
		}
		$stmt->close();				//close statement
		$mysqli->close();			//close mysqli
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
		session_start();									//start session
		carDelete($_SESSION["userID"], $_GET["id"]);		// call function with parameters
	}
	function carDelete($userID, $carID){					//carDelete function
		include "dbConnect.php";				//new mysqli
		$query = "DELETE FROM cars WHERE userID = ? AND ID = ?"; 		//query to delete car
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dd", $userID, $carID);
			if($stmt->execute()){
				header("location: ../user/userConfig.php");				//refer to userConfig.php
			}
		}
		$stmt->close();					//close statement
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
	function getUserInfo()
	{
		include "dbConnect.php";
		$sql = "SELECT cityID FROM user WHERE ID = ?";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get cityID
			$stmt->bind_param("d", $_SESSION["userID"]);
			$stmt->execute();
			$result = $stmt->get_result();
			while($data = $result->fetch_array()){
				$cityID = $data["cityID"];
			}
		}
		$stmt->close();										//close statement
		$sql = "SELECT name FROM city WHERE ID = ?";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get city name
			$stmt->bind_param("d", $cityID);
			$stmt->execute();
			$result = $stmt->get_result();
			while($data = $result->fetch_array()){
				$address = $data["name"];
			}
			$_SESSION['address'] = $address;							//save address in session
		}
		$stmt->close();										//close statement
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
	}
?>
