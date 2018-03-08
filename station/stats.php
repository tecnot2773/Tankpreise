<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include_once "../function/userFunctions.php";
	if(!isset($_SESSION["address"]) && $_SESSION['loggedin'] == true || !isset($_SESSION["type"]) && $_SESSION['loggedin'] == true){
		getUserInfo();
	}
	include "../function/dbConnect.php";
	include_once "../function/printStats.php";
	$id = $_GET["id"];
	$sql = "SELECT name FROM gasstation WHERE ID = ?";		//query to get ID from city
	if ($stmt = $mysqli->prepare($sql)) {			//prepare statement
		$stmt->bind_param("s", $id);			//bind parameter
		$stmt->execute();							//execute statement
		$result = $stmt->get_result();				//save result
		if($result->num_rows >= 1){
			while($data = $result->fetch_array()){		//fetch array
				$name = $data["name"];			//save id in cityID
			}
		}
	}
	$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="../images/icon.jpg">
		<link href="../css/custom/statPrint.css" type="text/css" rel="stylesheet" />
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
		<div id="center">
			<div id="griddiv-heading" class="white">
				<h3>Statstik für <?= $name ?> der letzden 7 Tage</h3>
			</div>
			<div id="griddiv-table" class="white">
				<?php statPrintStation("$id","diesel"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statPrintStation("$id","E5"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statPrintStation("$id","E10"); ?>
			</div>
		</div>
