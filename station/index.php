<?php
	session_start();
	include_once "../function/dbConnect.php";
	include_once "../station/statPrint.php";
	include_once "../function/getStationDetail.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="images/icon.jpg">
		<link href="../css/custom/stationIndex.css" type="text/css" rel="stylesheet" />
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
								<a><?php echo $_SESSION['username'] ?></a>
								<span class="icon icon-arrow-down2"></span>
								<div class="dropdown-content">
									<a href="../user/index.php">Benutzer Seite</a>
									<a href="../user/userConfig.php">Einstellungen</a>
									<a href="../function/logout.php">Logout</a>
								</div>
							</div>
						</li>
					<?php  }else{ ?>
						<li><a href="../statistics.php">Statistik</a></li>
						<li><a href="../register.php">Registrieren</a></li>
						<li><a href="../login.php">Login</a></li>
					<?php } ?>
					</ul>
				</nav>
			</div>
		</header>
		<!--main contents          -->
		<?php
			$UUID = $_GET["id"];
			$UUID = mysqli_real_escape_string($mysqli, $UUID);
			$id = mysqli_fetch_array(mysqli_query($mysqli, "SELECT ID FROM gasstation WHERE UUID = '$UUID';"))['ID'];

			$http_content = Detail::getDetail($UUID);
			$name = Detail::getName($http_content);
			$brand = Detail::getBrand($http_content);
			$place = Detail::getPlace($http_content);
			$street = Detail::getStreet($http_content);
			$housenumber = Detail::getHousenumber($http_content);
			$openingTimes = Detail::getOpeningtimes($http_content);
			$isopen = Detail::getIsopen($http_content);
			$e5 = Detail::getE5($http_content);
			$e10 = Detail::getE10($http_content);
			$diesel = Detail::getDiesel($http_content);
		?>
		<div id="heading" class="page-header">
			<h1> </h1>
		</div>
		<div id="griddiv-left" class="white">
			<div id="printrow-top" class="white">
				Name: <?php echo $name; ?>
			</div>
			<div id="printrow-middle" class="white">
				Marke: <?php echo $brand; ?>
			</div>
			<div id="printrow-middle" class="white">
				Addresse: <?php echo $place . ", " . $street . " " . $housenumber; ?>
			</div>
			<div id="printrow-middle" class="white">
				Öffnungszeiten: <?php echo $openingTimes[0]; ?>
			</div>
			<?php if(isset($openingTimes[1])){ ?>
			<div id="printrow-middle" class="white">
				Öffnungszeiten: <?php echo $openingTimes[1]; ?>
			</div>
			<?php } ?>
			<?php if(isset($openingTimes[2])){ ?>
			<div id="printrow-middle" class="white">
				Öffnungszeiten: <?php echo $openingTimes[2]; ?>
			</div>
			<?php } ?>
			<div id="printrow-middle" class="white">
				Derzeit geöffnet: <?php echo $isopen; ?>
			</div>
			<?php if($e5 != "null"){ ?>
			<div id="printrow-middle" class="white">
				<?php echo $e5; ?>
			</div>
			<?php } ?>
			<?php if($e10 != "null"){ ?>
			<div id="printrow-middle" class="white">
				<?php echo $e10; ?>
			</div>
			<?php } ?>
			<?php if($diesel != "null"){ ?>
			<div id="printrow-middle" class="white">
				<?php echo $diesel; ?>
			</div>
			<?php } ?>
			<?php if(!empty($id)){ ?>
			<div id="printrow-middle" class="white">
				<a href="stats.php?id=<?php echo $id; ?>">Statistiken der Preise der letzten 7 Tage</a>
			</div>
		<?php } ?>
		</div>
		<div id="griddiv-right" class="white">
			<div id="rowstart" class="white">
				<?php
				$place_new = preg_replace('/(?=\s)(.+?)(?=\w)/', '+', $place);
				$street_new = preg_replace('/(?=\s)(.+?)(?=\w)/', '+', $street);
				$number_new = preg_replace('/(?=\s)(.+?)(?=\w)/', '+', $housenumber);
				?>
				<iframe
					width="100%"
					height="450"
					frameborder="0" style="border:0"
					<?php if(isset($place_new) && isset($street_new)){
					echo "src='https://www.google.com/maps/embed/v1/place?key=AIzaSyB1t1KPpbk5Iji8NzrNzJwQ1rpyvfdIRO4&q=" . $place_new . "," . $street_new . "," . $number_new . "' allowfullscreen>";
					}else{
					echo "src='https://www.google.com/maps/embed/v1/place?key=AIzaSyB1t1KPpbk5Iji8NzrNzJwQ1rpyvfdIRO4&q=Syke' allowfullscreen>";
					} ?>
				</iframe>
			</div>
			<div id="rowend" class="white">
			</div>
		</div>
	</body>
</html>
