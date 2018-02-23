<?php
session_start();
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
		<link href="../css/custom/userConfig.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/body.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/textbox.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/navbar.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/buttons.css" type="text/css" rel="stylesheet" />
		<link href="../css/generic/icons.css" rel="stylesheet" />
		<style type="text/css">a {text-decoration: none; style="color: #fb3f00;}</style>
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
			<div id="center">
				<div id="griddiv-left" class="white">
					<div id="rowheader" class="white">
						Addresse
					</div>
					<div id="rowmid" class="white">
						<input id="textbox-large" name="text-place" class="enjoy-css" type="text" <?php if(isset($_SESSION["address"])){ ?> placeholder="<?= ucfirst($_SESSION['address']) ?>" <?php }else{ ?> placeholder="Wohnort" <?php }  ?>>
					</div>
					<div id="rowheader" class="white">
						Autos
					</div>
					<?php if(!isset($_GET["id"]) && !isset($_GET["name"]) && !isset($_GET["consumption"]) && !isset($_GET["volume"]) && !isset($_GET["type"])){ ?>
					<div id="rowmid" class="white">
						<input id="textbox-small" name="text-carname" class="enjoy-css" type="text" placeholder="Auto Name">
						<select id="textbox-small" name='text-type' class='enjoy-css'>
							<option value="Diesel">Diesel</option>
							<option value="E5">E5</option>
							<option value="E10">E10</option>
						</select>
					</div>
					<div id="rowend" class="white">
						<input id="textbox-small" name="text-volume" class="enjoy-css" type="text" placeholder="Tank Volumen in Liter">
						<input id="textbox-small" name="text-consumption" class="enjoy-css" type="text" placeholder="Verbrauch in Liter">
					</div>
					<?php } ?>
					<?php if(isset($_GET["id"]) && isset($_GET["name"]) && isset($_GET["consumption"]) && isset($_GET["volume"]) && isset($_GET["type"])){ ?>
					<div id="rowmid" class="white">
						<input id="textbox-small" name="text-carname" class="enjoy-css" type="text" placeholder="Auto Name" value = <?=$_GET["name"]?>>
						<select id="textbox-small" name='text-type' class='enjoy-css'>
							<option value="<?= $_GET["type"] ?>" selected hidden><?= $_GET["type"] ?></option>
							<option value="Diesel">Diesel</option>
							<option value="E5">E5</option>
							<option value="E10">E10</option>
						</select>
					</div>
					<div id="rowend" class="white">
						<input id="textbox-small" name="text-volume" class="enjoy-css" type="text" placeholder="Tank Volumen in Liter" value = <?=$_GET["volume"]?>>
						<input id="textbox-small" name="text-consumption" class="enjoy-css" type="text" placeholder="Verbrauch in Liter" value = <?=$_GET["consumption"]?>>
					</div>
					<div style="display:none" id="rowmid" class="white">
						<label>
							<input type="checkbox" name="box-edit" value="<?=$_GET["id"]?>" checked>
						</label>
					</div>
					<?php } ?>
				</div>
				<div id="griddiv-right" class="white">
					<div id="rowheader" class="white">
						Password Änderung
					</div>
					<div id="rowmid" class="white">
						<input id="textbox-large" name="text-currentpassword" class="enjoy-css" type="password" placeholder="Aktuelles Password">
					</div>
					<div id="rowmid" class="white">
						<input id="textbox-large" name="text-newpassword" class="enjoy-css" type="password" placeholder="Neues Password">
					</div>
					<div id="rowend" class="white">
						<input id="textbox-large" name="text-renewpassword" class="enjoy-css" type="password" placeholder="Password Wiederholen">
					</div>
				</div>
			</div>
			<div id="griddiv-submit" class="white">
				<div id="submitrow" class="white">
					<input class="button" type="submit" value="Eingabe">
				</div>
				<?php if(!empty($_POST["text-currentpassword"]) && !empty($_POST["text-newpassword"]) && !empty($_POST["text-renewpassword"]) || !empty($_POST["text-place"]) || !empty($_POST["text-carname"]) && !empty($_POST["text-consumption"]) && !empty($_POST["text-volume"]) && !empty($_POST["text-type"])){ ?>
				<div id="status" class="white">
					<?php
					if(!empty($_POST["text-place"])){ echo changePlace() . "<br>"; }
					if(!empty($_POST["text-currentpassword"]) && !empty($_POST["text-newpassword"]) && !empty($_POST["text-renewpassword"])){ echo changePassword() . "<br>"; }
					if(!empty($_POST["text-carname"]) && !empty($_POST["text-type"]) && !empty($_POST["text-volume"]) && !empty($_POST["text-consumption"]) && empty($_POST["box-edit"])){ echo addCar() . "<br>"; }
					if(!empty($_POST["text-carname"]) && !empty($_POST["text-type"]) && !empty($_POST["text-volume"]) && !empty($_POST["text-consumption"]) && !empty($_POST["box-edit"])){ echo editCar() . "<br>"; }
					 ?>
				</div>
				<?php } ?>
			</div>
			<?php
				$result = carTable();
				if($result->num_rows >= 1){
			?>
			<div id="griddiv-table" class="white">
				<div id='bottom-table' class='bottomrow'>
				<table id='cars'>
					<tr>
						<th>Name</th>
						<th>Volumen</th>
						<th>Verbrauch</th>
						<th>Sprit Sorte</th>
						<th>Aktion</th>
						<th>Aktion</th>
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
						<td width='40%'><?= $name ?></td>
						<td width='20%'><?= $volume ?></td>
						<td width='20%'><?= $consumption ?></td>
						<td width='20%'><?= $type ?></td>
						<td width='7px'>
							<a href='userConfig.php?id=<?= $id ?>&name=<?= $name ?>&volume=<?= $volume ?>&consumption=<?= $consumption ?>&type=<?= $type ?>'>
								<span>
									<span class="icon icon-pencil"></span>
								</span>
							</a>
						</td>
						<td width='7px'>
							<a href='../function/userConfig.php?id=<?= $id ?>&delete=true'>
								<span>
									<span class="icon icon-bin"></span>
								</span>
							</a>
						</td>
						</tr>
					<?php } ?>
					</table>
				</div>
			</div>
			<?php } ?>
		</form>
	</body>
</html>
