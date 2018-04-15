<?php
	if (session_status() == PHP_SESSION_NONE) {
	    session_start();
	}
	include_once "function/userFunctionsController.php";
	include_once "function/printStats.php";
	if(!isset($_SESSION["address"]) && isset($_SESSION['loggedin']) || !isset($_SESSION["type"]) && isset($_SESSION['loggedin']) == true){
		getUserInfo();		//Get userinfo
	}

	$status = $_GET['stats'];
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
		<link href="css/generic/table.css" type="text/css" rel="stylesheet" />
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
						<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
						<li>
						  <div class="dropdown">
						    <a>Statstik</a>
						    <div class="dropdown-content">
						      <a href="statistics?stats=week">Wöchentlich</a>
						      <a href="statistics?stats=day">Täglich</a>
						    </div>
						  </div>
						</li>
						<li>
							<div class="dropdown">
								<a><?= $_SESSION['username'] ?></a>
								<span class="icon icon-arrow-down2"></span>
								<div class="dropdown-content">
									<a href="user/index">Benutzer Seite</a>
									<a href="user/userConfig">Einstellungen</a>
									<a href="function/logout">Logout</a>
								</div>
							</div>
						</li>
					<?php  }else{ ?>
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
					<?php } ?>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->

		<div id="center">
			<?php if($status == "week") { ?>
			<div id="griddiv-heading" class="white">
				<h3>Statstik für alle Tankstellen im Radius von 25km um Syke der letzden 7 Tage</h3>
			</div>
			<div id="griddiv-table" class="white">
				<?php statsPrintTableAll("diesel"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statsPrintTableAll("e5"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statsPrintTableAll("e10"); ?>
			</div>
		<?php } if($status == "day") { ?>
			<div id="griddiv-heading" class="white">
				<h3>Statstik für alle Tankstellen im Radius von 25km um Syke der letzden 24 Stunden</h3>
			</div>
			<?php
				$stats = getStatsAll("diesel", date("d", strtotime("yesterday")), date("m", strtotime("yesterday")), date("Y", strtotime("yesterday")));
				if($stats == true){
					echo generateBarChart($stats, 50, "diesel");
				}
				$stats = getStatsAll("E5", date("d", strtotime("yesterday")), date("m", strtotime("yesterday")), date("Y", strtotime("yesterday")));
				if($stats == true){
					echo generateBarChart($stats, 50, "E5");
				}
				$stats = getStatsAll("E10", date("d", strtotime("yesterday")), date("m", strtotime("yesterday")), date("Y", strtotime("yesterday")));
				if($stats == true){
					echo generateBarChart($stats, 50, "E10");
				}
			}
			?>
		</div>
