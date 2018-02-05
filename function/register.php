<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		include_once "dbConnect.php";
		if(!empty($_POST["text-username"]) && !empty($password = $_POST["text-password"]) && !empty($repassword = $_POST["text-repassword"])){
			$username = $mysqli->real_escape_string($_POST["text-username"]);
			$password = $mysqli->real_escape_string($_POST["text-password"]);
			$repassword = $mysqli->real_escape_string($_POST["text-repassword"]);

			if($stmt = $mysqli->prepare("SELECT name FROM user WHERE name = ?;")){
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows == 0){
					$stmt->reset();
					if($password == $repassword){
						$hashed_password = password_hash($password, PASSWORD_DEFAULT);
						if($stmt = $mysqli->prepare("INSERT INTO `user`(`name`, `hashed_password`) VALUES (?, ?);")){
							$stmt->bind_param("ss", $username, $hashed_password);
							$stmt->execute();

							echo "Benutzer wurde erfolgreich angelegt.";
							header("location: login.php");
							$stmt->close();
						}
					}
					else{
						echo "Die Passwörter stimmen nicht überein.";
					}
				}
				else{
					echo "Der Benutzername ist bereits Vergeben.";
				}
			}
		}
		else{
			echo "Bitte füllen Sie alle Felder aus.";
		}
		mysqli_close($mysqli);
	}
 ?>
