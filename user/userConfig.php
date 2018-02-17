<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="../images/icon.jpg">
		<link href="../css/custom/userConfig.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/body.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/textbox.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/navbar.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/buttons.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/icons.css" rel="stylesheet" />
		<title>Tankstellen Preise</title>
	</head>
	<body>
		<!--navbar -->
		<header>
			<div class="container">
				<a href="../index.php">
					<img src="../images/Header.png" alt="logo" class="logo" />
				</a>
				<nav>
					<ul>
						<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
						<li><a href="../statistics.php">Statistik</a></li>
						<li>
							<div class="dropdown">
								<a><?= $_SESSION['username'] ?></a>
								<span class="icon icon-arrow-down2"></span>
								<div class="dropdown-content">
									<a href="../user/index.php">Benutzer Seite</a>
									<a href="../user/userConfig.php">Einstellungen</a>
									<a href="../function/logout.php">Logout</a>
								</div>
							</div>
						</li>
					<?php }else{ header("location: ../login.php"); } ?>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->
		<form action="userConfig.php" method="post">
			<div id="heading" class="page-header">
				<h1>Benutzer Einstellungen</h1>
			</div>
				<div id="griddiv-left" class="white">
					<div id="rowstart" class="white">
						Addresse
					</div>
					<div id="rowmid" class="white">
						<input id="textbox-large" name="text-place" class="enjoy-css" type="text" placeholder="Wohnort">
					</div>
					<div id="rowmid" class="white">
						Autos
					</div>
					<div id="rowend" class="white">
						<input id="textbox-small" name="text-carname" class="enjoy-css" type="text" placeholder="Auto Name">
						<input id="textbox-small" name="text-consumption" class="enjoy-css" type="text" placeholder="Verbrauch">
					</div>
				</div>
				<div id="griddiv-right" class="white">
					<div id="rowstart" class="white">
						Password
					</div>
					<div id="rowmid" class="white">
						<input id="textbox-large" name="text-currentpassword" class="enjoy-css" type="text" placeholder="Aktuelles Password">
					</div>
					<div id="rowmid" class="white">
						<input id="textbox-large" name="text-newpassword" class="enjoy-css" type="text" placeholder="Neues Password">
					</div>
					<div id="rowend" class="white">
						<input id="textbox-large" name="text-renewpassword" class="enjoy-css" type="text" placeholder="Password Wiederholen">
					</div>
				</div>
				<div id="griddiv-search" class="white">
					<div id="searchrow" class="white">
						<input class="button" type="submit" value="Eingabe">
						<?php include_once "../function/userConfig.php"; ?>
					</div>
				</div>
		</form>
	</body>
</html>
