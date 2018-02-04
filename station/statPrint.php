<?php
	function statPrint($stationID, $type){

		include "../function/dbConnect.php";

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
			$day = date("d", strtotime("last Monday"));
			$month = date("m", strtotime("last Monday"));
			$year = date("Y", strtotime("last Monday"));
			$mondayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '$stationID' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;");
			?>
		  <tr>
		    <th id="tg-yw4l">Monday</th>
				<?php while($data = mysqli_fetch_array($mondayData)){ ?>
					<td id="tg-yw4l"><?php echo $data[$type]; ?></td>
				<?php } ?>
		  </tr>

			<?php
			$day = date("d", strtotime("last Tuesday"));
			$month = date("m", strtotime("last Tuesday"));
			$year = date("Y", strtotime("last Tuesday"));
			$tuesdayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '$stationID' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;");
			?>
			<tr>
				<th id="tg-yw4l">Dienstag</th>
				<?php while($data = mysqli_fetch_array($tuesdayData)){ ?>
					<td id="tg-yw4l"><?php echo $data[$type]; ?></td>
				<?php } ?>
			</tr>

			<?php
			$day = date("d", strtotime("last Wednesday"));
			$month = date("m", strtotime("last Wednesday"));
			$year = date("Y", strtotime("last Wednesday"));
			$wednesdayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '$stationID' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;");
			?>
			<tr>
				<th id="tg-yw4l">Mittwoch</th>
				<?php while($data = mysqli_fetch_array($wednesdayData)){ ?>
					<td id="tg-yw4l"><?php echo $data[$type]; ?></td>
				<?php } ?>
			</tr>

			<?php
			$day = date("d", strtotime("last Thursday"));
			$month = date("m", strtotime("last Thursday"));
			$year = date("Y", strtotime("last Thursday"));
			$thursdayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '$stationID' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;");
			?>
			<tr>
				<th id="tg-yw4l">Donnerstag</th>
				<?php while($data = mysqli_fetch_array($thursdayData)){ ?>
					<td id="tg-yw4l"><?php echo $data[$type]; ?></td>
				<?php } ?>
			</tr>

			<?php
			$day = date("d", strtotime("last Friday"));
			$month = date("m", strtotime("last Friday"));
			$year = date("Y", strtotime("last Friday"));
			$fridayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '$stationID' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;");
			?>
			<tr>
				<th id="tg-yw4l">Freitag</th>
				<?php while($data = mysqli_fetch_array($fridayData)){ ?>
					<td id="tg-yw4l"><?php echo $data[$type]; ?></td>
				<?php } ?>
			</tr>

			<?php
			$day = date("d", strtotime("last Saturday"));
			$month = date("m", strtotime("last Saturday"));
			$year = date("Y", strtotime("last Saturday"));
			$saturdayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '$stationID' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;");
			?>
		  <tr>
		    <th id="tg-yw4l">Samstag</th>
				<?php while($data = mysqli_fetch_array($saturdayData)){ ?>
					<td id="tg-yw4l"><?php echo $data[$type]; ?></td>
				<?php } ?>
		  </tr>

			<?php
			$day = date("d", strtotime("last Sunday"));
			$month = date("m", strtotime("last Sunday"));
			$year = date("Y", strtotime("last Sunday"));
			$sundayData = mysqli_query($conn, "SELECT * FROM stats WHERE gasStationID = '$stationID' AND MONTH(timestamp) = '$month' AND DAY(timestamp) = '$day' AND YEAR(timestamp) = '$year' ORDER BY timestamp ASC;");
			?>
		  <tr>
		    <th id="tg-yw4l">Sonntag</th>
				<?php while($data = mysqli_fetch_array($sundayData)){ ?>
					<td id="tg-yw4l"><?php echo $data[$type]; ?></td>
				<?php } ?>
		  </tr>

		</table>
	<?php } ?>
