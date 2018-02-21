<?php
	function register(){
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

							$status = "Benutzer wurde erfolgreich angelegt.";
							header("location: login.php");
							$stmt->close();
						}
					}
					else{
						$status = "Die Passwörter stimmen nicht überein.";
					}
				}
				else{
					$status = "Der Benutzername ist bereits Vergeben.";
				}
			}
		}
		else{
			$status = "Bitte füllen Sie alle Felder aus.";
		}
		mysqli_close($mysqli);
		return $status;
	}
	function login(){
		include_once "dbConnect.php";

		if(empty(trim($_POST["text-username"]))){														//check if username is emtpy
	  	$username_error = 'Bitte geben Sie ihren Benutzernamen ein.';			//if empty echo error
			$status = $username_error;
	  }
		else{
	  	$username = $mysqli->real_escape_string($_POST["text-username"]);			//save escaped username
	  }

		if(empty(trim($_POST['text-password']))){														//check if password is emtpy
	    $password_error = 'Bitte geben Sie ihr Passwort ein.';						//if empty echo error
			$status = $password_error;
	  }
		else{
	    $password = $mysqli->real_escape_string($_POST['text-password']);			//save escaped password
	  }

		if(empty($username_error) && empty($password_error)){										//if password and username isset
			$sql = "SELECT name, hashed_password, ID FROM user WHERE name = ?";
			if($stmt = $mysqli->prepare($sql)){																		//prepare to get hashed_password
				$stmt->bind_param("s", $param_username);														//bind parameter to statement

				$param_username = $username;
				if($stmt->execute()){																							//execute statement
					$result = $stmt->get_result();																	//save result
					if($result->num_rows == 1){																			//check if there is an user with that name
						while($data = $result->fetch_array()){												//fetch result
						$username = $data["name"];																		//name as username
						$hashed_password = $data["hashed_password"];									//hashed_password as hashed_password
						$userID = $data["ID"];
						}
						if(password_verify($password, $hashed_password)){							//vertify password
							session_start();																						//start session
							$_SESSION['username'] = $username;													//save username in session
							$_SESSION['loggedin'] = true;																//save loggedin status in session
							$_SESSION['userID'] = $userID;
							header("location: index.php");															//refer to index.php
						}
						else{
							$status = "Falsches Password";																		//if vertify password was false
						}
					}
					else{
						$status = "Benutzer nicht gefunden";																//if no user with input name was found
					}
				}
				$stmt->close();
			}
			$mysqli->close();																										//close DB connection
		}
		return $status;
	}
 ?>
