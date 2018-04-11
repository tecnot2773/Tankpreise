<?php
function statsPrintTableAll($type){
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
			if(empty($data['avgPrice']) ||$data['avgPrice'] == "null"){return;}} ?>
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
			  if ($stmt1 = $mysqli->prepare($query1)) {		//prepare statement to get stats
				  for($i = 0; $i < 7; $i++){
					  switch ($i) {
						  case 0: $name = "Monday";
								  $nameGer = "Montag";
						  case 1: $name = "Tuesday";
								  $nameGer = "Dienstag";
						  case 2: $name = "Wednesday";
								  $nameGer = "Mittwoch";
						  case 3: $name = "Thursday";
								  $nameGer = "Donnerstag";
						  case 4: $name = "Friday";
								  $nameGer = "Freitag";
						  case 1: $name = "Saturday";
								  $nameGer = "Samstag";
						  case 1: $name = "Sunday";
								  $nameGer = "Sonntag";
					  }
			$stmt->bind_param("ddds", $month, $day, $year, $type);		//bind parameters
			$day = date("d", strtotime("last ${name}"));		//day from last monday
			$month = date("m", strtotime("last ${name}"));	//month from last monday
			$year = date("Y", strtotime("last ${name}"));	//year from last monday
			$stmt->execute();			//execute statement
			$result = $stmt->get_result();		//save result
			if ($stmt1 = $mysqli->prepare($query1)) {		//prepare statement to get stats
			$stmt1->bind_param("sddd", $type, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
			<th><?= $nameGer ?></th>
				<?php while($data = $result->fetch_array()){ ?>		<!-- fetch array -->
					<?php if($data['avgPrice'] <= $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td> 		<!-- echo type -->
				<?php }}?>
		  </tr>
		</table>
<?php }}}$mysqli->close();} ?>
