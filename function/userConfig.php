<?php
	if(isset($_POST["text-place"])){
		include_once "dbConnect.php";
		include_once "UTF8Convert.php";
		include_once "getKoordinates.php";
		$address = $_POST["text-place"];
		$address = umlauts($address);
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
					echo "test1";
					$cityID = getKoordinates($address, $mysqli);
					$cityID = $cityID[2];
				}
			}
			else{
				echo "test2";

			}
		}
		$query = "UPDATE user SET cityID = ? WHERE ID = ?;";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dd", $cityID, $userID);
			$userID = $_SESSION['userID'];
			$stmt->execute();
		}
	}




?>
