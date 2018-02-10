<?php
	function statPrint($stationID, $type){

		include "../function/dbConnect.php";
		$query = "SELECT * FROM stats WHERE gasStationID = ? AND MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? ORDER BY timestamp ASC;";
		?>
		<link href="../css/custom/statPrint.css" type="text/css" rel="stylesheet" />

		<table id="tg" style="undefined;table-layout: fixed; width: 643px">
			<colgroup>
				<col style="width: 100px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
				<col style="width: 60px">
			</colgroup>
		  <tr>
		    <th id="tg-yw4l">\</th>
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
			if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Monday"));
			$month = date("m", strtotime("last Monday"));
			$year = date("Y", strtotime("last Monday"));
			$stmt->execute();
			$result = $stmt->get_result();
			?>
		  <tr>
		    <th id="tg-yw4l">Montag</th>
				<?php while($data = $result->fetch_array()){ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
				<?php }?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Tuesday"));
			$month = date("m", strtotime("last Tuesday"));
			$year = date("Y", strtotime("last Tuesday"));
			$stmt->execute();
			$result = $stmt->get_result();
			?>
		  <tr>
		    <th id="tg-yw4l">Dienstag</th>
				<?php while($data = $result->fetch_array()){ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
				<?php }?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Wednesday"));
			$month = date("m", strtotime("last Wednesday"));
			$year = date("Y", strtotime("last Wednesday"));
			$stmt->execute();
			$result = $stmt->get_result();
			?>
		  <tr>
		    <th id="tg-yw4l">Mittwoch</th>
				<?php while($data = $result->fetch_array()){ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
				<?php }?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Thursday"));
			$month = date("m", strtotime("last Thursday"));
			$year = date("Y", strtotime("last Thursday"));
			$stmt->execute();
			$result = $stmt->get_result();
			?>
		  <tr>
		    <th id="tg-yw4l">Donnerstag</th>
				<?php while($data = $result->fetch_array()){ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
				<?php }?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Friday"));
			$month = date("m", strtotime("last Friday"));
			$year = date("Y", strtotime("last Friday"));
			$stmt->execute();
			$result = $stmt->get_result();
			?>
		  <tr>
		    <th id="tg-yw4l">Freitag</th>
				<?php while($data = $result->fetch_array()){ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
				<?php }?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Saturday"));
			$month = date("m", strtotime("last Saturday"));
			$year = date("Y", strtotime("last Saturday"));
			$stmt->execute();
			$result = $stmt->get_result();
			?>
		  <tr>
		    <th id="tg-yw4l">Samstag</th>
				<?php while($data = $result->fetch_array()){ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
				<?php }?>
		  </tr>

			<?php
			$stmt->bind_param("dsss", $stationID, $month, $day, $year);
			$day = date("d", strtotime("last Sunday"));
			$month = date("m", strtotime("last Sunday"));
			$year = date("Y", strtotime("last Sunday"));
			$stmt->execute();
			$result = $stmt->get_result();
			?>
		  <tr>
		    <th id="tg-yw4l">Sonntag</th>
				<?php while($data = $result->fetch_array()){ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
				<?php } $stmt->close();}?>
		  </tr>

		</table>
	<?php } ?>
