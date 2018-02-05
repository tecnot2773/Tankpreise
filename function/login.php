<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include_once "dbConnect.php";

	if(empty(trim($_POST["text-username"]))){														//check if username is emtpy
  	$username_error = 'Bitte geben Sie ihren Benutzernamen ein.';			//if empty echo error
		echo $username_error;
  }
	else{
  	$username = $mysqli->real_escape_string($_POST["text-username"]);			//save escaped username
  }

	if(empty(trim($_POST['text-password']))){														//check if password is emtpy
    $password_error = 'Bitte geben Sie ihr Passwort ein.';						//if empty echo error
		echo $password_error;
  }
	else{
    $password = $mysqli->real_escape_string($_POST['text-password']);			//save escaped password
  }

	if(empty($username_error) && empty($password_error)){										//if password and username isset
		$sql = "SELECT name, hashed_password FROM user WHERE name = ?";
		if($stmt = $mysqli->prepare($sql)){																		//prepare to get hashed_password
			$stmt->bind_param("s", $param_username);														//bind parameter to statement

			$param_username = $username;
			if($stmt->execute()){																							//execute statement
				$result = $stmt->get_result();																	//save result
				if($result->num_rows == 1){																			//check if there is an user with that name
					while($data = $result->fetch_array()){												//fetch result
					$username = $data["name"];																		//name as username
					$hashed_password = $data["hashed_password"];									//hashed_password as hashed_password
					}
					if(password_verify($password, $hashed_password)){							//vertify password
						session_start();																						//start session
						$_SESSION['username'] = $username;													//save username in session
						$_SESSION['loggedin'] = true;																//save loggedin status in session
						header("location: index.php");															//refer to index.php
					}
					else{
						echo "Falsches Password";																		//if vertify password was false
					}
				}
				else{
					echo "Benutzer nicht gefunden";																//if no user with input name was found
				}
			}
			$stmt->close();
		}
		$mysqli->close();																										//close DB connection
	}
}
?>
