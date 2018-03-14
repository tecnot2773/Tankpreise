<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	include_once "function/userFunctions.php";
	include_once "function/printStats.php";
	if(!isset($_SESSION["address"]) && $_SESSION['loggedin'] == true || !isset($_SESSION["type"]) && $_SESSION['loggedin'] == true){
		getUserInfo();		//Get userinfo
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="images/icon.jpg">
		<link href="css/custom/statistics.css" type="text/css" rel="stylesheet" />
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
				<a href="index.php">
					<img src="images/Header.png" alt="logo" class="logo" />
				</a>
				<nav>
					<ul>
						<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
						<li><a href="statistics.php">Statistik</a></li>
						<li>
							<div class="dropdown">
								<a><?= $_SESSION['username'] ?></a>
								<span class="icon icon-arrow-down2"></span>
								<div class="dropdown-content">
									<a href="user/index.php">Benutzer Seite</a>
									<a href="user/userConfig.php">Einstellungen</a>
									<a href="function/logout.php">Logout</a>
								</div>
							</div>
						</li>
					<?php  }else{ ?>
						<li><a href="statistics.php">Statistik</a></li>
						<li><a href="register.php">Registrieren</a></li>
						<li><a href="login.php">Login</a></li>
					<?php } ?>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->
		<div id="center">
			<div id="griddiv-heading" class="white">
				<h3>Statstik für alle Tankstellen im Radius von 25km um Syke der letzden 7 Tage</h3>
			</div>
			<div id="griddiv-table" class="white">
				<?php statPrintAll("diesel"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statPrintAll("E5"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statPrintAll("E10"); ?>
			</div>
		</div>
