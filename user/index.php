<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include_once "../function/userFunctions.php";
	include_once "../function/accountFunctions.php";
	if(!isset($_SESSION["address"]) && $_SESSION['loggedin'] == true || !isset($_SESSION["type"]) && $_SESSION['loggedin'] == true){
		getUserInfo();
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="shortcut icon" type="image/x-icon" href="../images/icon.jpg">
		<link href="../css/custom/userIndex.css" type="text/css" rel="stylesheet" />
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
		<div id="heading" class="page-header">
			<h1>Benutzer Seite von <?= $_SESSION["username"] ?></h1>
		</div>
		<div id="griddiv-top" class="white">
			<div id='rowstart' class='bottomrow'>
				<b>Benutzername:</b> <?= $_SESSION["username"] ?> &nbsp;&nbsp;&nbsp;&nbsp; <b>Wohnort:</b> <?php if(isset($_SESSION["address"])){ echo ucfirst($_SESSION["address"]); }else{echo "Bitte geben Sie einen Wohnort in den Benutzereinstellungen an, um alle Funktionen richtig nutzen zu können.";} ?>
			</div>
		</div>
		<?php
			if(isset($_SESSION['address'])){
				$result = carTable();
				if($result->num_rows >= 1){
		?>
		<div id="griddiv-table" class="white">
			<table id='cars'>
				<tr>
					<th>Auto Name</th>
					<th>Sprit Sorte</th>
					<th>Tank Volumen</th>
					<th>Kosten für einen Tank</th>
					<th>Verbrauch auf 100km</th>
					<th>Kosten für 100km</th>
					<th>Günstigster Preis für einen Liter</th>
					<th>Günstigeste Tankstelle in <?= ucfirst($_SESSION["address"]) ?></th>
				</tr>
				<?php
				$lowest = getLowestPrice($_SESSION["address"]);
				while($data = $result->fetch_array()){
					$name = $data["name"];
					$volume = $data["volume"];
					$consumption = $data["consumption"];
					$type = $data["type"];
					$id = $data["ID"];
					if($type == "Diesel"){
						$lowestDiesel = $lowest['dieselPrice'];
						$dieselName = $lowest['dieselName'];
						$dieselUUID = $lowest['dieselID'];
					}
					if($type == "E5"){
						$lowestE5 = $lowest['e5Price'];
						$e5Name = $lowest['e5Name'];
						$e5UUID = $lowest['e5ID'];
					}
					if($type == "E10"){
						$lowestE10 = $lowest['e10Price'];
						$e10Name = $lowest['e10Name'];
						$e10UUID = $lowest['e10ID'];
					}
				?>
				<tr>
					<?php if($type == "Diesel"){ ?>
					<td width='20%'><?= $name ?></td>
					<td width='10%'><?= $type ?></td>
					<td width='10%'><?= $volume ?> Liter</td>
					<td width='10%'><?= number_format($volume * $lowestDiesel, 2, ',', '') ?> Euro</td>
					<td width='10%'><?= $consumption ?> Liter</td>
					<td width='10%'><?= number_format($consumption * $lowestDiesel, 2, ',', '') ?> Euro</td>
					<td width='10%'><?= $lowestDiesel ?> Euro</td>
					<td width='10%'>
						<a href='../station/index.php?id=<?= $dieselUUID ?>'><?= $dieselName ?></a>
					</td>
					<?php } ?>
					<?php if($type == "E5"){ ?>
					<td width='20%'><?= $name ?></td>
					<td width='10%'><?= $type ?></td>
					<td width='10%'><?= $volume ?> Liter</td>
					<td width='10%'><?= number_format($volume * $lowestE5, 2, ',', '') ?> Euro</td>
					<td width='10%'><?= $consumption ?> Liter</td>
					<td width='10%'><?= number_format($consumption * $lowestE5, 2, ',', '') ?> Euro</td>
					<td width='10%'><?= $lowestE5 ?> Euro</td>
					<td width='10%'>
						<a href='../station/index.php?id=<?= $e5UUID ?>'><?= $e5Name ?></a>
					</td>
					<?php } ?>
					<?php if($type == "E10"){ ?>
					<td width='20%'><?= $name ?></td>
					<td width='10%'><?= $type ?></td>
					<td width='10%'><?= $volume ?> Liter</td>
					<td width='10%'><?= number_format($volume * $lowestE10, 2, ',', '') ?> Euro</td>
					<td width='10%'><?= $consumption ?> Liter</td>
					<td width='10%'><?= number_format($consumption * $lowestE10, 2, ',', '') ?> Euro</td>
					<td width='10%'><?= $lowestE10 ?> Euro</td>
					<td width='10%'>
						<a href='../station/index.php?id=<?= $e10UUID ?>'><?= $e10Name ?></a>
					</td>
					<?php } ?>
				</tr>
			<?php }} ?>
			</table>
		</div>
		<?php } ?>
	</body>
</html>
