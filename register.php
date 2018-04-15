<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {header("location: index.php");}else{
	include_once "function/accountController";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="images/icon.jpg">
		<link href="css/custom/register.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/body.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/textbox.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/navbar.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/buttons.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/icons.css" rel="stylesheet" />
		<title>Tankstellen Preise</title>
	</head>
	<body>
		<!--navbar -->
		<header>
			<div class="container">
				<a href="index">
					<img src="images/Header.png" alt="logo" class="logo" />
				</a>
				<nav>
					<ul>
						<li>
						  <div class="dropdown">
						    <a>Statstik</a>
						    <div class="dropdown-content">
						      <a href="statistics?stats=week">Wöchentlich</a>
						      <a href="statistics?stats=day">Täglich</a>
						    </div>
						  </div>
						</li>
						<li><a href="register">Registrieren</a></li>
						<li><a href="login">Login</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->
		<form action="register.php" method="post">
			<div id="heading" class="page-header">
				<h1>Registrieren</h1>
			</div>
			<div id="griddiv-register" class="white">
				<div id="inputrow-top" class="white">
					<span class="icon icon-user"></span>
					<input id="textbox-large" name="text-username" class="enjoy-css" type="text" placeholder="Benutzername">
					Mindestens 3 Zeichen
				</div>
				<div id="inputrow-middle" class="white">
					<span class="icon icon-lock"></span>
					<input id="textbox-large" name="text-password" class="enjoy-css" type="password" placeholder="Passwort">
					Mindestens 6 Zeichen
				</div>
				<div id="inputrow-middle" class="white">
					<span class="icon icon-lock"></span>
					<input id="textbox-large" name="text-repassword" class="enjoy-css" type="password" placeholder="Password Wiederholen">
				</div>
				<div id="inputrow-middle" class="white">
					<input class="button" type="submit" name="submit" value="Registrieren">
				</div>
				<div id="inputrow-middle" class="white">
					<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo register();} ?>
				</div>
			</div>
	</body>
</html>
<?php } ?>
