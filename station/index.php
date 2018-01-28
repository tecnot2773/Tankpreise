<?php session_start(); ?>
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
								<a><?php echo $_SESSION['username'] ?>&#8609;</a>
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
	include_once "../function/dbConnect.php";
	include_once "../station/statPrint.php";
	$UUID = $_GET["id"];
	$id = mysqli_fetch_array(mysqli_query($conn, "SELECT ID FROM gasstation WHERE UUID = '$UUID';"))['ID'];
?>



<?php
	echo "UUID: " . $UUID . "<br>";
	echo "<h3>Diesel</h3>";
	statPrint("$id","diesel");
	echo "<h3>E5</h3>";
	statPrint("$id","E5");
	echo "<h3>E10</h3>";
	statPrint("$id","E10");
 ?>
