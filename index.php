<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "function/userConfig.php";
if(!isset($_SESSION["address"]) || !isset($_SESSION["type"])){
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
		<link href="css/custom/index.css" type="text/css" rel="stylesheet" />
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
		<?php
		$status = "notReady";
			if(isset($_GET["address"]) && isset($_GET["radius"]) && isset($_GET["type"])){
				include "function/dbConnect.php";
				$address = $mysqli->real_escape_string($_GET["address"]);
				$radius = $mysqli->real_escape_string($_GET["radius"]);
				$type = $mysqli->real_escape_string($_GET["type"]);
				$status = "ready";		//if user has filled the fields
			}
			if(isset($_SESSION['address']) && isset($_SESSION['type']) && !isset($_GET["address"])){

				$address = $_SESSION['address'];
				$radius = "5";
				$type = $_SESSION['type'];
				$status = "ready";			//if user has not filed the fields but has user data in database
			}
			if($status == "ready"){
				include_once "function/getStation.php";
				$sort = "request";
				$decoded = getStations($address, $radius, $type);
				$name = getName($decoded, $sort);
				$place = getPlace($decoded, $sort);
				$brand = getBrand($decoded, $sort);
				$street = getStreet($decoded, $sort);
				$houseNumber = getHousenumber($decoded, $sort);
				$UUID = getUUID($decoded, $sort);
				$price = getPrice($decoded);

				$count = count($name);
			}
			?>
		<form action="index.php" method="get">
				<div id="griddiv-search" class="white">
					<div id="searchrow" class="white">
						<?php if(isset($_GET["address"])){ ?>
							<input name="address" class="enjoy-css" type="text" placeholder="<?= $_GET["address"]; ?>" value="<?= $_GET["address"]; ?>">
						<?php }else{ ?>
							<input name="address" class="enjoy-css" type="text" placeholder="Standort">
						<?php } ?>
						<select name='radius' class='enjoy-css'>
							<?php if(isset($_GET["radius"])){ ?>
							<option value="<?= $_GET["radius"]; ?>" selected hidden>Radius <?= $_GET["radius"]; ?>km</option>
							<?php } ?>
							<option value="5">Radius 5km</option>
							<option value="10">Radius 10km</option>
							<option value="15">Radius 15km</option>
							<option value="20">Radius 20km</option>
							<option value="25">Radius 25km</option>
						</select>
						<select name='type' class='enjoy-css'>
							<?php if(isset($_GET["type"])){ ?>
							<option value="<?= $_GET["type"]; ?>" selected hidden><?= $_GET["type"]; ?></option>
							<?php } ?>
							<option value="Diesel">Diesel</option>
							<option value="E5">E5</option>
							<option value="E10">E10</option>
						</select>
						<input class="button" type="submit" value="Eingabe">
					</div>
				</div>
				<div id="griddiv-left" class="white">
						<?php if(isset($_GET["address"]) && isset($_GET["radius"]) && isset($_GET["type"]) || isset($_SESSION["type"]) && isset($_SESSION["address"])){
							for ($i = 0; $i < $count; $i++) { ?>
								<div id="rowstart" class="white">
									<a href="station/index.php?id=<?= $UUID[$i] ?>"><?= $name[$i] ?></a>
								</div>
								<div id="rowmid" class="white">
									Marke: <?= $brand[$i] ?>
								</div>
								<div id="rowmid" class="white">
									Stadt: <?= $place[$i] ?>
								</div>
								<div id="rowmid" class="white">
									Straße: <?= $street[$i] . " " . $houseNumber[$i]?>
								</div>
								<div id="rowmid" class="white">
									<?= ucfirst($type) . ": " . $price[$i] ?>
								</div>
							<?php }} ?>
					<div id="rowend" class="white">
					</div>
				</div>
				<div id="griddiv-right" class="white">
					<div id="rowstart" class="white">
						<iframe
  						width="100%"
  						height="450"
  						frameborder="0" style="border:0"
							<?php if($status == "ready"){
							echo "src='https://www.google.com/maps/embed/v1/place?key=AIzaSyB1t1KPpbk5Iji8NzrNzJwQ1rpyvfdIRO4&q=" . $place[0] . "," . $street[0] . "," . $houseNumber[0] . "' allowfullscreen>";
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
