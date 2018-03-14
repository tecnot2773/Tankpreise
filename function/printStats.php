<?php
	function statPrintStation($stationID, $type){

		include "dbConnect.php";
		//query to get Stats
		$query = "SELECT * FROM stats WHERE gasStationID = ? AND MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? ORDER BY timestamp ASC;";
		$query1 = "SELECT MIN($type) AS MINI FROM stats WHERE gasStationID = ? AND MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ?";
		if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
		$stmt->bind_param("dsss", $stationID, $month, $day, $year);		//bind parameters
		$day = date("d", strtotime("last Monday"));		//day from last monday
		$month = date("m", strtotime("last Monday"));	//month from last monday
		$year = date("Y", strtotime("last Monday"));	//year from last monday
		$stmt->execute();			//execute statement
		$result = $stmt->get_result();		//save result
		 while($data = $result->fetch_array()){
			if(empty($data['avgPrice']) ||$data['avgPrice'] == "null"){die();}} ?>
			<h3><?=ucfirst($type)?><h3>
		<table id="stats" style="undefined;table-layout: fixed; width: 100%">
			<colgroup>
				<col style="width: 15%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
				<col style="width: 10%">
			</colgroup>
		  <tr>
		    <th id="tg-yw4l">\</th> <!-- hours -->
		    <th id="tg-yw4l">0</th>
		    <th id="tg-yw4l">1</th>
		    <th id="tg-yw4l">2</th>
		    <th id="tg-yw4l">3</th>
		    <th id="tg-yw4l">4</th>
		    <th id="tg-yw4l">5</th>
		    <th id="tg-yw4l">6</th>
		    <th id="tg-yw4l">7</th>
		    <th id="tg-yw4l">8</th>
		    <th id="tg-yw4l">9</th>
		    <th id="tg-yw4l">10</th>
		    <th id="tg-yw4l">11</th>
		    <th id="tg-yw4l">12</th>
		    <th id="tg-yw4l">13</th>
		    <th id="tg-yw4l">14</th>
		    <th id="tg-yw4l">15</th>
		    <th id="tg-yw4l">16</th>
		    <th id="tg-yw4l">17</th>
		    <th id="tg-yw4l">18</th>
		    <th id="tg-yw4l">19</th>
		    <th id="tg-yw4l">20</th>
		    <th id="tg-yw4l">21</th>
		    <th id="tg-yw4l">22</th>
		    <th id="tg-yw4l">23</th>
		  </tr>

			<?php
			if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);		//bind parameters
			$day = date("d", strtotime("last Monday"));		//day from last monday
			$month = date("m", strtotime("last Monday"));	//month from last monday
			$year = date("Y", strtotime("last Monday"));	//year from last monday
			$stmt->execute();			//execute statement
			$result = $stmt->get_result();		//save result
			if ($stmt1 = $mysqli->prepare($query1)) {		//prepare statement to get stats
			$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
			 	$lowest = $data["MINI"];
			}
			?>
		  <tr>
		    <th>Montag</th>
				<?php while($data = $result->fetch_array()){ ?>		<!-- fetch array -->
					<?php if($data['avgPrice'] == $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Tuesday"));
			$month = date("m", strtotime("last Tuesday"));
			$year = date("Y", strtotime("last Tuesday"));
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
		    <th id="tg-yw4l">Dienstag</th>
			<?php while($data = $result->fetch_array()){ ?>		<!-- fetch array -->
				<?php if($data['avgPrice'] == $lowest){ ?>
					<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }else{ ?>
					<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
			<?php }}?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Wednesday"));
			$month = date("m", strtotime("last Wednesday"));
			$year = date("Y", strtotime("last Wednesday"));
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
		    <th id="tg-yw4l">Mittwoch</th>
			<?php while($data = $result->fetch_array()){
				 if($data['avgPrice'] == $lowest){ ?>
					<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }else{ ?>
					<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
			<?php }}?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Thursday"));
			$month = date("m", strtotime("last Thursday"));
			$year = date("Y", strtotime("last Thursday"));
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
		    <th id="tg-yw4l">Donnerstag</th>
			<?php while($data = $result->fetch_array()){
				if($data['avgPrice'] == $lowest){ ?>
					<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }else{ ?>
					<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
			<?php }}?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Friday"));
			$month = date("m", strtotime("last Friday"));
			$year = date("Y", strtotime("last Friday"));
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
		    <th id="tg-yw4l">Freitag</th>
			<?php while($data = $result->fetch_array()){
				if($data['avgPrice'] == $lowest){ ?>
					<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }else{ ?>
					<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
			<?php }}?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Saturday"));
			$month = date("m", strtotime("last Saturday"));
			$year = date("Y", strtotime("last Saturday"));
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
		    <th id="tg-yw4l">Samstag</th>
			<?php while($data = $result->fetch_array()){
				if($data['avgPrice'] == $lowest){ ?>
					<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }else{ ?>
					<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
			<?php }}?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Sunday"));
			$month = date("m", strtotime("last Sunday"));
			$year = date("Y", strtotime("last Sunday"));
			$stmt->execute();
			$result = $stmt->get_result();
			$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
		    <th id="tg-yw4l">Sonntag</th>
			<?php while($data = $result->fetch_array()){
				if($data['avgPrice'] == $lowest){ ?>
					<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }else{ ?>
					<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
			<?php }}?>
		  </tr>

		</table>
	<?php }}}$mysqli->close();}

	function statPrintAll($type){
			include "dbConnect.php";
			//query to get Stats
			$query = "SELECT * FROM avgPriceDaily WHERE MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? AND type = ? ORDER BY timestamp ASC";
			$query1 = "SELECT MIN(avgPrice) AS MINI FROM avgPriceDaily WHERE type = ? AND MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ?";
			if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
			$stmt->bind_param("ssss", $month, $day, $year, $type);		//bind parameters
			$day = date("d", strtotime("last Monday"));		//day from last monday
			$month = date("m", strtotime("last Monday"));	//month from last monday
			$year = date("Y", strtotime("last Monday"));	//year from last monday
			$stmt->execute();			//execute statement
			$result = $stmt->get_result();		//save result
			 while($data = $result->fetch_array()){
				if(empty($data['avgPrice']) ||$data['avgPrice'] == "null"){die();}} ?>
				<h3><?=ucfirst($type)?><h3>
			<table id="stats" style="undefined;table-layout: fixed; width: 100%">
				<colgroup>
					<col style="width: 15%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
					<col style="width: 10%">
				</colgroup>
			  <tr>
			    <th id="tg-yw4l">\</th> <!-- hours -->
			    <th id="tg-yw4l">0</th>
			    <th id="tg-yw4l">1</th>
			    <th id="tg-yw4l">2</th>
			    <th id="tg-yw4l">3</th>
			    <th id="tg-yw4l">4</th>
			    <th id="tg-yw4l">5</th>
			    <th id="tg-yw4l">6</th>
			    <th id="tg-yw4l">7</th>
			    <th id="tg-yw4l">8</th>
			    <th id="tg-yw4l">9</th>
			    <th id="tg-yw4l">10</th>
			    <th id="tg-yw4l">11</th>
			    <th id="tg-yw4l">12</th>
			    <th id="tg-yw4l">13</th>
			    <th id="tg-yw4l">14</th>
			    <th id="tg-yw4l">15</th>
			    <th id="tg-yw4l">16</th>
			    <th id="tg-yw4l">17</th>
			    <th id="tg-yw4l">18</th>
			    <th id="tg-yw4l">19</th>
			    <th id="tg-yw4l">20</th>
			    <th id="tg-yw4l">21</th>
			    <th id="tg-yw4l">22</th>
			    <th id="tg-yw4l">23</th>
			  </tr>

				<?php
				if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
				$stmt->bind_param("ssss", $month, $day, $year, $type);		//bind parameters
				$day = date("d", strtotime("last Monday"));		//day from last monday
				$month = date("m", strtotime("last Monday"));	//month from last monday
				$year = date("Y", strtotime("last Monday"));	//year from last monday
				$stmt->execute();			//execute statement
				$result = $stmt->get_result();		//save result
				if ($stmt1 = $mysqli->prepare($query1)) {		//prepare statement to get stats
				$stmt1->bind_param("dddd", $type, $month, $day, $year);		//bind parameters
				$stmt1->execute();			//execute statement
				$result1 = $stmt1->get_result();		//save result
				while($data = $result1->fetch_array()){
				 	$lowest = $data["MINI"];
				}
				?>
			  <tr>
			    <th>Montag</th>
					<?php while($data = $result->fetch_array()){ ?>		<!-- fetch array -->
						<?php if($data['avgPrice'] == $lowest){ ?>
							<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
						<?php }else{ ?>
							<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }}?>
			  </tr>

				<?php
				$day = date("d", strtotime("last Tuesday"));
				$month = date("m", strtotime("last Tuesday"));
				$year = date("Y", strtotime("last Tuesday"));
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt1->execute();			//execute statement
				$result1 = $stmt1->get_result();		//save result
				while($data = $result1->fetch_array()){
					$lowest = $data["MINI"];
				}
				?>
			  <tr>
			    <th id="tg-yw4l">Dienstag</th>
				<?php while($data = $result->fetch_array()){ ?>		<!-- fetch array -->
					<?php if($data['avgPrice'] == $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
			  </tr>

				<?php
				$day = date("d", strtotime("last Wednesday"));
				$month = date("m", strtotime("last Wednesday"));
				$year = date("Y", strtotime("last Wednesday"));
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt1->execute();			//execute statement
				$result1 = $stmt1->get_result();		//save result
				while($data = $result1->fetch_array()){
					$lowest = $data["MINI"];
				}
				?>
			  <tr>
			    <th id="tg-yw4l">Mittwoch</th>
				<?php while($data = $result->fetch_array()){
					 if($data['avgPrice'] == $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
			  </tr>

				<?php
				$day = date("d", strtotime("last Thursday"));
				$month = date("m", strtotime("last Thursday"));
				$year = date("Y", strtotime("last Thursday"));
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt1->execute();			//execute statement
				$result1 = $stmt1->get_result();		//save result
				while($data = $result1->fetch_array()){
					$lowest = $data["MINI"];
				}
				?>
			  <tr>
			    <th id="tg-yw4l">Donnerstag</th>
				<?php while($data = $result->fetch_array()){
					if($data['avgPrice'] == $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
			  </tr>

				<?php
				$day = date("d", strtotime("last Friday"));
				$month = date("m", strtotime("last Friday"));
				$year = date("Y", strtotime("last Friday"));
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt1->execute();			//execute statement
				$result1 = $stmt1->get_result();		//save result
				while($data = $result1->fetch_array()){
					$lowest = $data["MINI"];
				}
				?>
			  <tr>
			    <th id="tg-yw4l">Freitag</th>
				<?php while($data = $result->fetch_array()){
					if($data['avgPrice'] == $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
			  </tr>

				<?php
				$day = date("d", strtotime("last Saturday"));
				$month = date("m", strtotime("last Saturday"));
				$year = date("Y", strtotime("last Saturday"));
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt1->execute();			//execute statement
				$result1 = $stmt1->get_result();		//save result
				while($data = $result1->fetch_array()){
					$lowest = $data["MINI"];
				}
				?>
			  <tr>
			    <th id="tg-yw4l">Samstag</th>
				<?php while($data = $result->fetch_array()){
					if($data['avgPrice'] == $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
			  </tr>

				<?php
				$day = date("d", strtotime("last Sunday"));
				$month = date("m", strtotime("last Sunday"));
				$year = date("Y", strtotime("last Sunday"));
				$stmt->execute();
				$result = $stmt->get_result();
				$stmt1->execute();			//execute statement
				$result1 = $stmt1->get_result();		//save result
				while($data = $result1->fetch_array()){
					$lowest = $data["MINI"];
				}
				?>
			  <tr>
			    <th id="tg-yw4l">Sonntag</th>
				<?php while($data = $result->fetch_array()){
					if($data['avgPrice'] == $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
			  </tr>

			</table>
		<?php }}}$mysqli->close();} ?>
