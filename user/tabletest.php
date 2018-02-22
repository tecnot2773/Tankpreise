<!DOCTYPE html>
<link href="../css/custom/userConfig.css" type="text/css" rel="stylesheet" />
<?php

	include "../function/dbConnect.php";
	//$userID = $_SESSION["userID"];
	$userID = "1";

	$query = "SELECT ID, name, volume, consumption, type FROM cars WHERE userID = ?";
	if ($stmt = $mysqli->prepare($query)) {
		$stmt->bind_param("d", $userID);
		$stmt->execute();
		$result = $stmt->get_result();
		if(!empty($result)){
			if($result->num_rows >= 1){
				echo "<form action='userConfig.php' method='post'>";
				echo "<div id='bottom-table' class='bottomrow'>";
				echo "<table id='cars'>\r\n";
				echo "<tr>\r\n";
				echo "<th>Name</th>\r\n";
				echo "<th>Volumen</th>\r\n";
				echo "<th>Verbrauch</th>\r\n";
				echo "<th>Sprit Sorte</th>\r\n";
				echo "<th>Aktion</th>\r\n";
				echo "<th>Aktion</th>\r\n";
				echo "</tr>\r\n";
				while($data = $result->fetch_array()){
					$name = $data["name"];
					$volume = $data["volume"];
					$consumption = $data["consumption"];
					$type = $data["type"];
					$id = $data["ID"];

					echo "<tr class='userlistoutput'>\r\n";
					echo "<td width='20%'>" . $name . "</td>\r\n";
					echo "<td width='10%'>" . $volume . "</td>\r\n";
					echo "<td width='10%'>" . $consumption . "</td>\r\n";
					echo "<td width='10%'>" . $type . "</td>\r\n";
					echo "<td width='2.5%'>";
					echo "<td width='2.5%'>";


					echo "<a href='include/deleteVacation.php?Id=${id}' class=vtable-link danger'>";
							echo "<span class='fa-stack'>";
									echo "<i class='fa fa-square fa-stack-2x'></i>";
									echo "<i class='fa fa-trash-o fa-stack-1x fa-inverse'></i>";
							echo "</span>";
					echo "</a>";
					echo "</td>\r\n";
					echo "</tr>\r\n";
				}
				echo "</table>\r\n";
			}
		}
	}
  ?>
