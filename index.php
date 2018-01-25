<?php session_start(); ?>
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
						<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>
						<li><a href="#">Statistik</a></li>
						<li>
							<div class="dropdown">
								<a><?php echo $_SESSION['username'] ?>&#8609;</a>
								<div class="dropdown-content">
									<a href="user/index.php">Benutzer Seite</a>
									<a href="user/userConfig.php">Einstellungen</a>
									<a href="function/logout.php">Logout</a>
								</div>
							</div>
						</li>
					<?php  }else{ ?>
						<li><a href="#">Statistik</a></li>
						<li><a href="register.php">Registrieren</a></li>
						<li><a href="login.php">Login</a></li>
					<?php } ?>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->
		<form action="index.php" method="get">
			<div id="heading" class="page-header">
				<h1>Suchen Sie die günstigste Tankstelle in ihrer Nähe</h1>
			</div>
				<div id="griddiv-search" class="white">
					<div id="searchrow" class="white">
						<?php if(isset($_GET["address"])){ ?>
							<input name="address" class="enjoy-css" type="text" placeholder="<?php echo $_GET["address"]; ?>" value="<?php echo $_GET["address"]; ?>">
						<?php }else{ ?>
							<input name="address" class="enjoy-css" type="text" placeholder="Standort">
						<?php } ?>
						<select name='radius' class='enjoy-css'>
							<?php if(isset($_GET["radius"])){ ?>
							<option value="<?php echo $_GET["radius"]; ?>" selected hidden>Radius <?php echo $_GET["radius"]; ?>km</option>
							<?php } ?>
							<option value="5">Radius 5km</option>
							<option value="10">Radius 10km</option>
							<option value="15">Radius 15km</option>
							<option value="20">Radius 20km</option>
							<option value="25">Radius 25km</option>
						</select>
						<select name='type' class='enjoy-css'>
							<?php if(isset($_GET["type"])){ ?>
							<option value="<?php echo $_GET["type"]; ?>" selected hidden><?php echo $_GET["type"]; ?></option>
							<?php } ?>
							<option value="diesel">Diesel</option>
							<option value="e5">E5</option>
							<option value="e10">E10</option>
						</select>
						<input class="button" type="submit" value="Eingabe">
					</div>
				</div>
				<div id="griddiv-left" class="white">
					<div id="rowstart" class="white">
						<?php include_once "function/getKoordinates.php"; ?>
					</div>
					<div id="rowend" class="white">
					</div>
				</div>
				<div id="griddiv-right" class="white">
					<div id="rowstart" class="white">
						<?php //if(isset($longitude[1])){echo "Longitude: " . $longitude[1] . "<br>\n Latitude: " . $latitude[1];}?>
						<iframe
  						width="100%"
  						height="450"
  						frameborder="0" style="border:0"
							<?php if(isset($_GET["address"]) && isset($_GET["radius"]) && isset($_GET["type"])){
							echo "src='https://www.google.com/maps/embed/v1/place?key=AIzaSyB1t1KPpbk5Iji8NzrNzJwQ1rpyvfdIRO4&q=" . $town_new . "," . $street_new . "," . $number_new . "' allowfullscreen>";
							}else{
							echo "src='https://www.google.com/maps/embed/v1/place?key=AIzaSyB1t1KPpbk5Iji8NzrNzJwQ1rpyvfdIRO4&q=Syke' allowfullscreen>";
							} ?>
						</iframe>
					</div>
					<div id="rowend" class="white">
					</div>
				</div>
		</form>
	</body>
</html>
