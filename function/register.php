<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		include_once "dbConnect.php";
		if(!empty($_POST["text-username"]) && !empty($password = $_POST["text-password"]) && !empty($repassword = $_POST["text-repassword"])){
			$username = $_POST["text-username"];
			$password = $_POST["text-password"];
			$repassword = $_POST["text-repassword"];

			if(mysqli_num_rows(mysqli_query($conn, "SELECT name FROM user WHERE name = '$username';")) == 0){
				if($password == $repassword){
					$hashed_password = password_hash($password, PASSWORD_DEFAULT);
					mysqli_query($conn, "INSERT INTO `user`(`name`, `password`, `consumption`, `cityID`) VALUES ('$username','$hashed_password',NULL,NULL);");

					echo "Benutzer wurde erfolgreich angelegt.";
				}
				else{
					echo "Die Passwörter stimmen nicht überein.";
				}
			}
			else{
				echo "Der Benutzername ist bereits Vergeben.";
			}
		}
		else{
			echo "Bitte füllen Sie alle Felder aus.";
		}
	}
 ?>
