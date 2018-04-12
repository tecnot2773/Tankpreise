<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include_once "../function/dbConnect.php";
	include_once "../function/printStats.php";
	include_once "../function/getStationDetail.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="../images/icon.jpg">
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
						<li>
						  <div class="dropdown">
						    <a>Statstik</a>
						    <div class="dropdown-content">
						      <a href="../statistics.php?stats=week">Wöchentlich</a>
						      <a href="../statistics.php?stats=day">Täglich</a>
						    </div>
						  </div>
						</li>
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
					<?php  }else{ ?>
						<li>
						  <div class="dropdown">
						    <a>Statstik</a>
						    <div class="dropdown-content">
						      <a href="../statistics.php?stats=week">Wöchentlich</a>
						      <a href="../statistics.php?stats=day">Täglich</a>
						    </div>
						  </div>
						</li>
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
			$UUID = $mysqli->real_escape_string($UUID);
			$id = mysqli_fetch_array(mysqli_query($mysqli, "SELECT ID FROM gasstation WHERE UUID = '$UUID';"))['ID'];

			$http_content = getDetail($UUID);
			$name = getName($http_content);
			$brand = getBrand($http_content);
			$place = getPlace($http_content);
			$street = getStreet($http_content);
			$housenumber = getHousenumber($http_content);
			$openingTimes = getOpeningtimes($http_content);
			$isopen = getIsopen($http_content);
			$e5 = getE5($http_content);
			$e10 = getE10($http_content);
			$diesel = getDiesel($http_content);
		?>
		<div id="griddiv-left" class="white">
			<table style="width:100%">
			  <tr>
			    <th>Name</th>
			    <td><?= $name; ?></td>
			  </tr>
			  <tr>
			    <th>Marke</th>
			    <td><?= $brand; ?></td>
			  </tr>
			  <tr>
			    <th>Addresse</th>
			    <td><?php echo $place . " " . $street . " " . $housenumber; ?></td>
			  </tr>
			  <tr>
				<th>Öffnungszeiten</th>
				<td><?= $openingTimes[0]; ?></td>
			  </tr>
			  <?php if(isset($openingTimes[1])){ ?>
				  <tr>
					<th>Öffnungszeiten</th>
					<td><?= $openingTimes[1]; ?></td>
				  </tr>
			  <?php } if(isset($openingTimes[2])){ ?>
				  <tr>
					<th>Öffnungszeiten</th>
					<td><?= $openingTimes[2]; ?></td>
				  </tr>
			  <?php } ?>
			  <tr>
				<th>Derzeit geöffnet</th>
				<td><?= $isopen; ?></td>
			  </tr>
			  <?php if(isset($e5)){ ?>
				  <tr>
					<th>E5 Preis</th>
					<td><?= $e5; ?> Euro</td>
				  </tr>
			  <?php } if(isset($e10)){ ?>
				  <tr>
					<th>E10 Preis</th>
					<td><?= $e10; ?> Euro</td>
				  </tr>
			  <?php } if(isset($diesel)){ ?>
				  <tr>
					<th>Diesel Preis</th>
					<td><?= $diesel; ?> Euro</td>
				  </tr>
			  <?php } ?>
			</table>
			<?php if(!empty($id)){ ?>
			<div id="printrow-middle" class="white">
				<a href="stats.php?id=<?= $id; ?>&stats=week">Statistiken der Preise der letzten 7 Tage</a>
			</div>
			<div id="printrow-middle" class="white">
				<a href="stats.php?id=<?= $id; ?>&stats=day">Statistiken der Preise des letzten Tages</a>
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
