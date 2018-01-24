<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	include_once "dbConnect.php";

	if(empty(trim($_POST["text-username"]))){
  	$username_error = 'Bitte geben Sie ihren Benutzernamen ein.';
		echo $username_error;
  }
	else{
  	$username = ($_POST["text-username"]);
  }

	if(empty(trim($_POST['text-password']))){
    $password_error = 'Bitte geben Sie ihr Passwort ein.';
		echo $password_error;
  }
	else{
    $password = ($_POST['text-password']);
  }

	if(empty($username_error) && empty($password_error)){
		$sql = "SELECT name, password FROM user WHERE name = ?";

		if($stmt = mysqli_prepare($conn, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $param_username);

			$param_username = $username;

			if(mysqli_stmt_execute($stmt)){
				mysqli_stmt_store_result($stmt);

				if(mysqli_stmt_num_rows($stmt) == 1){
					mysqli_stmt_bind_result($stmt, $username, $hashed_password);

					if(mysqli_stmt_fetch($stmt)){
						echo strlen($hashed_password);
						if(password_verify($password, $hashed_password)){
							session_start();
							$_SESSION['username'] = $username;
							$_SESSION['loggedin'] = true;
							header("location: index.php");
						}
						else{
							echo "Falsches Password";
						}
					}
				}
				else{
					echo "Benutzer nicht gefunden";
				}
			}
		}
		mysqli_close($conn);
	}
}
?>
