<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="images/icon.jpg">
		<link href="css/custom/index.css" type="text/css" rel="stylesheet" />
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
						<li><a href="#">Registrieren</a></li>
						<li><a href="#">Login</a></li>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->
		<form action="index.php" method="post">
			<div id="heading" class="page-header">
				<h1>Suchen Sie die günstigste Tankstelle in ihrer Nähe</h1>
			</div>
			<div id="griddiv-search" class="container">
				<div id="searchrow" class="row">
					<input id="text-address" name="text-address" class="enjoy-css" type="text" placeholder="Standort">
					<input class="button" type="submit" name="submit" value="Eingabe">
				</div>
			</div>
			<div id="main-area" class="container">
				<div id="griddiv-left" class="test">
					<div id="rowstart" class="row">
						<?php include_once "function/getKoordinates.php"; ?>
					</div>
					<div id="rowend" class="row">
					</div>
				</div>
				<div id="griddiv-right" class="test">
					<div id="rowstart" class="row">
						TODO: list or map
					</div>
					<div id="rowend" class="row">
					</div>
					<div id="resultstring" class="alert alert-info">
					</div>
				</div>
			</div>
		</form>
	</body>
</html>
