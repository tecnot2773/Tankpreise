<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include_once "../function/userFunctions.php";
	if(isset($_SESSION['loggedin'])){
		if(!isset($_SESSION["address"]) || !isset($_SESSION["type"])){
			getUserInfo();
		}
	}
	include_once "../function/printStats.php";
	include_once "../function/getStationDetail.php";
	$id = $_GET["id"];
	$status = $_GET["stats"];
	$name = getStationName($id);
	if(empty($_GET["stats"])){header("location: ../index.php");}
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
		<link href="../css/generic/table.css" type="text/css" rel="stylesheet" />
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
			<?php if($status == "week"){ ?>
			<div id="griddiv-heading" class="white">
				<h3>Statstik für <?= $name ?> der letzden 7 Tage</h3>
			</div>
			<div id="griddiv-table" class="white">
				<?php statsPrintTableSingle("$id","diesel"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statsPrintTableSingle("$id","E5"); ?>
			</div>
			<div id="griddiv-table" class="white">
				<?php statsPrintTableSingle("$id","E10"); ?>
			</div>
		<?php } if($status == "day"){ ?>
			<div id="griddiv-heading" class="white">
				<h3>Statstik für <?= $name ?> der letzden 24 Stunden</h3>
			</div>
			<?php
				$stats = getStatsSingle("diesel", date("d", strtotime("yesterday")), date("m", strtotime("yesterday")), $id);
				if($stats == true){
					echo generateBarChart($stats, 50, "diesel");
				}
				$stats = getStatsSingle("E5", date("d", strtotime("yesterday")), date("m", strtotime("yesterday")), $id);
				if($stats == true){
					echo generateBarChart($stats, 50, "E5");
				}
				$stats = getStatsSingle("E10", date("d", strtotime("yesterday")), date("m", strtotime("yesterday")), $id);
				if($stats == true){
					echo generateBarChart($stats, 50, "E10");
				}
			}
			?>
		</div>
