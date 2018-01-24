<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="images/icon.jpg">
		<link href="css/custom/login.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/body.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/textbox.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/navbar.css" type="text/css" rel="stylesheet" />
		<link href="css/generic/buttons.css" type="text/css" rel="stylesheet" />
		<title>Tankstellen Preise</title>
	</head>
	<body>
		<!--navbar -->
		<header>
			<div class="container">
				<a href="index.php">
					<img src="images/Header.png" alt="logo" class="logo" />
				</a>
				<nav>
					<ul>
						<li><a href="register.php">Registrieren</a></li>
						<li><a href="login.php">Login</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->
		<form action="login.php" method="post">
			<div id="heading" class="page-header">
				<h1>Login</h1>
			</div>
			<div id="griddiv-register" class="white">
				<div id="inputrow-top" class="white">
					<input id="textbox-large" name="text-username" class="enjoy-css" type="text" placeholder="Benutzername">
				</div>
				<div id="inputrow-middle" class="white">
					<input id="textbox-large" name="text-password" class="enjoy-css" type="password" placeholder="Passwort">
				</div>
				<div id="inputrow-middle" class="white">
					<input class="button" type="submit" name="submit" value="Login">
				</div>
				<div id="inputrow-middle" class="white">
					<?php include_once "function/login.php"; ?>
				</div>
			</div>
	</body>
</html>
