<?php
	function register(){		//register function
		include "dbConnect.php";		// create new mysqli
		if(!empty($_POST["text-username"]) && !empty($password = $_POST["text-password"]) && !empty($repassword = $_POST["text-repassword"])){
			$username = $mysqli->real_escape_string($_POST["text-username"]);		//escape and save text-username
			$password = $mysqli->real_escape_string($_POST["text-password"]);		//esacpe and save text-password
			$repassword = $mysqli->real_escape_string($_POST["text-repassword"]);	//esacpe and save text-repassword

			if($stmt = $mysqli->prepare("SELECT name FROM user WHERE name = ?;")){	//prepare to get name from user
				$stmt->bind_param("s", $username);					// bind parameter
				$stmt->execute();									//execute statement
				$result = $stmt->get_result();						//save result
				if($result->num_rows == 0){							// if there is an result
					$stmt->reset();									//reset statement
					if($password == $repassword){					//if password is the same as repassword
						$hashed_password = password_hash($password, PASSWORD_DEFAULT);		//hash password
						if($stmt = $mysqli->prepare("INSERT INTO `user`(`name`, `hashed_password`) VALUES (?, ?);")){		//prepare to create new user in database
							$stmt->bind_param("ss", $username, $hashed_password);		//bind parameter
							$stmt->execute();				//execute statement

							$status = "Benutzer wurde erfolgreich angelegt.";	//status
							header("location: login.php");			//refer to login
							$stmt->close();			//close statement
						}
					}
					else{
						$status = "Die Passwörter stimmen nicht überein.";	//status if passwords dont match
					}
				}
				else{
					$status = "Der Benutzername ist bereits Vergeben.";		//status if username is taken
				}
			}
		}
		else{
			$status = "Bitte füllen Sie alle Felder aus.";			//status if not all fields are filed
		}
		$mysqli->close();			//close mysqli
		return $status;			//return status
	}

	function login(){				//login function
		include "dbConnect.php";

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
						$stmt->close();
						if(password_verify($password, $hashed_password)){							//vertify password
							if (session_status() == PHP_SESSION_NONE) {
    							session_start();
							}																						//start session
							$_SESSION['username'] = $username;													//save username in session
							$_SESSION['loggedin'] = true;																//save loggedin status in session
							$_SESSION['userID'] = $userID;
							header("location: user/index.php");															//refer to index.php
							include_once "userFunctions.php";
							getUserInfo();
						}
						else{
							$status = "Falsches Password";																		//if vertify password was false
						}
					}
					else{
						$status = "Benutzer nicht gefunden";																//if no user with input name was found
					}
				}
			}
			$mysqli->close();																										//close DB connection
		}
		if(isset($status)){return $status;};
	}

	function changePassword()
	{
		include "dbConnect.php";
		$currentPassword = $mysqli->real_escape_string($_POST["text-currentpassword"]);							//save and escape text-currentpassword
		$newPassword = $mysqli->real_escape_string($_POST["text-newpassword"]);									//save and escape text-newpassword
		$reNewPassword = $mysqli->real_escape_string($_POST["text-renewpassword"]);								//save and escape text-renewpassword
		$userID = $_SESSION['userID'];

		if($newPassword == $reNewPassword){					//if password matches repassword
			$password_error = "false";							//no error
		}
		else{
			$password_error = "true";									//error
			$status = "Die Passwörter stimmen nicht überein";			//status
		}

		if($password_error == "false"){													//if there was no error
			$sql = "SELECT hashed_password FROM user WHERE ID = ?";							//query to get hashed_password from user
			if($stmt = $mysqli->prepare($sql)){																		//prepare to get hashed_password
				$stmt->bind_param("d", $userID);
				if($stmt->execute()){											//execute statement
					$result = $stmt->get_result();
					$stmt->close();												//close statement
					while($data = $result->fetch_array()){												//fetch result
						$hashed_password = $data["hashed_password"];							//save hashed_password
					}
					if(password_verify($currentPassword, $hashed_password)){		//vertify inputpassword with hashed_password
						$sql = "UPDATE user SET hashed_password = ? WHERE ID = ?";		//query to update password
						if($stmt = $mysqli->prepare($sql)){									//prepare statement if vertify was successful
							$password = password_hash($newPassword, PASSWORD_DEFAULT);		//hash password
							$stmt->bind_param("sd", $password, $userID);
							if($stmt->execute()){											//execute statement
								$status = "Password wurde erfolgreich geändert.";			//status if password is changed
							}
						}
					}
					else{
						$status = "Das eingegeben Password ist nicht korrekt.";				//status if password is not correct
					}
				}
			}
		}
		$mysqli->close();				//close mysqli
		return $status;					//return status
	}

 ?>
