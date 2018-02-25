<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include_once "../function/userConfig.php";
	include_once "../function/accountFunctions.php";
	if(!isset($_SESSION["address"]) || !isset($_SESSION["type"])){
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
				<b>Benutzername:</b> <?= $_SESSION["username"] ?> &nbsp;&nbsp;&nbsp;&nbsp; <b>Wohnort:</b> <?= ucfirst($_SESSION["address"]) ?>
			</div>
		</div>
		<?php
			$result = carTable();
			if($result->num_rows >= 1){
		?>
		<div id="griddiv-table" class="white">
			<table id='cars'>
				<tr>
					<th>Name</th>
					<th>Volumen</th>
					<th>Verbrauch</th>
					<th>Sprit Sorte</th>
					<th>#</th>
					<th>#</th>
					<th>#</th>
				</tr>
				<?php
				while($data = $result->fetch_array()){
					$name = $data["name"];
					$volume = $data["volume"];
					$consumption = $data["consumption"];
					$type = $data["type"];
					$id = $data["ID"];
				?>
				<tr>
					<td width='20%'><?= $name ?></td>
					<td width='10%'><?= $volume ?></td>
					<td width='10%'><?= $consumption ?></td>
					<td width='10%'><?= $type ?></td>
					<td width='10%'></td>
					<td width='10%'></td>
					<td width='10%'></td>
				</tr>
			<?php } ?>
			</table>
		</div>
		<?php } ?>
	</body>
</html>
