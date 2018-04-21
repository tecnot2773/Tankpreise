<?php
function statsPrintTableSingle($stationID, $type){
	include "dbConnect.php";
	//query to get Stats
	$query = "SELECT * FROM stats WHERE gasStationID = ? AND MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? ORDER BY timestamp ASC;";
	$query1 = "SELECT MIN($type) AS MINI FROM stats WHERE gasStationID = ? AND MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ?";
	if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
	$stmt->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
	$day = date("d", strtotime("last Monday"));		//day from last monday
	$month = date("m", strtotime("last Monday"));	//month from last monday
	$year = date("Y", strtotime("last Monday"));	//year from last monday
	$stmt->execute();			//execute statement
	$result = $stmt->get_result();		//save result
	 while($data = $result->fetch_array()){
		if(empty($data[$type]) || $data[$type] == "null"){return;}
	}
	?>
	<h3>Preis pro Liter <?=ucfirst($type)?></h3>
	<table id="stats" style="undefined;table-layout: fixed; width: 100%">
		<colgroup>
			<col style="width: 15%">
			<?php for($i = 0; $i < 24; $i++){ ?>
				<col style="width: 10%">
			<?php } ?>
		</colgroup>
	  <tr>
		<th id="tg-yw4l">\</th> <!-- hours -->
		<?php for($i = 0; $i < 24; $i++){ ?>
			<th id="tg-yw4l"><?= $i ?></th>
		<?php } ?>
	  </tr>

		<?php
		if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
			if ($stmt1 = $mysqli->prepare($query1)) {		//prepare statement to get stats
				for($i = 0; $i < 7; $i++){
					switch ($i) {
						case 0: $name = "Monday";
								$nameGer = "Montag";
								break;
						case 1: $name = "Tuesday";
								$nameGer = "Dienstag";
								break;
						case 2: $name = "Wednesday";
								$nameGer = "Mittwoch";
								break;
						case 3: $name = "Thursday";
								$nameGer = "Donnerstag";
								break;
						case 4: $name = "Friday";
								$nameGer = "Freitag";
								break;
						case 5: $name = "Saturday";
								$nameGer = "Samstag";
								break;
						case 6: $name = "Sunday";
								$nameGer = "Sonntag";
								break;
					}
					$stmt->bind_param("dsss", $stationID, $month, $day, $year);		//bind parameters
					$day = date("d", strtotime("last ${name}"));		//day from last monday
					$month = date("m", strtotime("last ${name}"));	//month from last monday
					$year = date("Y", strtotime("last ${name}"));	//year from last monday
					$stmt->execute();			//execute statement
					$result = $stmt->get_result();		//save result
					$stmt1->bind_param("dddd", $stationID, $month, $day, $year);		//bind parameters
					$stmt1->execute();			//execute statement
					$result1 = $stmt1->get_result();		//save result
					while($data = $result1->fetch_array()){
						$lowest = $data["MINI"];
					}
		?>
	  <tr>
		<th><?= $nameGer ?></th>
			<?php while($data = $result->fetch_array()){ ?>
				<?php if($data[$type] == $lowest){ ?>
					<td id="low"><?= $data[$type]; ?></td>
				<?php }else{ ?>
					<td id="tg-yw4l"><?= $data[$type]; ?></td>
			<?php }}?>
	  </tr>
<?php }}} echo "</table>"; }} ?>

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
			<h3>Preis pro Liter <?=ucfirst($type)?><h3>
		<table id="stats" style="undefined;table-layout: fixed; width: 100%">
			<colgroup>
				<col style="width: 15%">
				<?php for($i = 0; $i < 24; $i++){ ?>
					<col style="width: 10%">
				<?php } ?>
			</colgroup>
		  <tr>
			<th id="tg-yw4l">\</th> <!-- hours -->
			<?php for($i = 0; $i < 24; $i++){ ?>
				<th id="tg-yw4l"><?= $i ?></th>
			<?php } ?>
		  </tr>

		  <?php
		  if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
			  if ($stmt1 = $mysqli->prepare($query1)) {		//prepare statement to get stats
				  for($i = 0; $i < 7; $i++){
					  switch ($i) {
						  case 0: $name = "Monday";
								  $nameGer = "Montag";
								  break;
						  case 1: $name = "Tuesday";
								  $nameGer = "Dienstag";
								  break;
						  case 2: $name = "Wednesday";
								  $nameGer = "Mittwoch";
								  break;
						  case 3: $name = "Thursday";
								  $nameGer = "Donnerstag";
								  break;
						  case 4: $name = "Friday";
								  $nameGer = "Freitag";
								  break;
						  case 5: $name = "Saturday";
								  $nameGer = "Samstag";
								  break;
						  case 6: $name = "Sunday";
								  $nameGer = "Sonntag";
								  break;
					  }
			$stmt->bind_param("ddds", $month, $day, $year, $type);		//bind parameters
			$day = date("d", strtotime("last ${name}"));		//day from last monday
			$month = date("m", strtotime("last ${name}"));	//month from last monday
			$year = date("Y", strtotime("last ${name}"));	//year from last monday
			$stmt->execute();			//execute statement
			$result = $stmt->get_result();		//save result
			$stmt1->bind_param("sddd", $type, $month, $day, $year);		//bind parameters
			$stmt1->execute();			//execute statement
			$result1 = $stmt1->get_result();		//save result
			while($data = $result1->fetch_array()){
				$lowest = $data["MINI"];
			}
			?>
		  <tr>
			<th><?= $nameGer ?></th>
				<?php while($data = $result->fetch_array()){ ?>
					<?php if($data['avgPrice'] <= $lowest){ ?>
						<td id="low"><?= $data['avgPrice']; ?></td>
					<?php }else{ ?>
						<td id="tg-yw4l"><?= $data['avgPrice']; ?></td>
				<?php }}}?>
		  </tr>
		</table>
<?php }}}$mysqli->close();} ?>

<?php
	function generateBarChart(&$values, $height=400, $type, $css_prefix='')
	{
	    $max = -1;
		$low = 10000;
	    $out = "<div id='griddiv-table' class='white'><h3>Preis pro Liter " . ucfirst($type) . "<h3><table class='chart'>";
	    foreach($values as $key=>$value) {
	        if (abs($value) > $max) {
	            $max = abs($value);
			}
		}
		foreach($values as $key=>$value) {
			if (abs($value) < $low) {
				$low = abs($value);
			}
		}

	    if ($max != 0) {
	        $kf = $height / $max;
	    } else {
	        $kf = 0;
		}

	    $out .= "<tr class='{$css_prefix}barvrow'>";
	    foreach($values as $key=>$value) {
	        $bar_height = abs(round((substr($value, 2) / 100)*$kf));
			if($value == $max){
	        	$out .= "<td style='border-bottom-width: {$bar_height}px; border-bottom-color: red'>{$value}</td>";
			}elseif($value == $low){
				$out .= "<td style='border-bottom-width: {$bar_height}px; border-bottom-color: green'>{$value}</td>";
			}
			else{
				$out .= "<td style='border-bottom-width: {$bar_height}px; border-bottom-color: orange'>{$value}</td>";
			}
	    }
	    $out .= '</tr>';


	    $out .= "<tr class='{$css_prefix}bartrow'>";

	    foreach($values as $key=>$value) {
	        $out .= "<td>{$key}</td>";
		}

	    $out .= "</tr>";
	    $out .= "</table></div>";
	    return $out;
	}

	function getStatsSingle($type, $day, $month, $year, $stationID)
	{
		include "dbConnect.php";
		$check = true;
		$query = "SELECT * FROM `stats` WHERE Day(timestamp) = ? AND Month(timestamp) = ? AND YEAR(timestamp) = ? AND gasstationID = ?";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("dddd", $day, $month, $year, $stationID);
			$stmt->execute();
			$first = 0;
			$result = $stmt->get_result();
			while($data = $result->fetch_array()){
				$date = date("H", strtotime($data['timestamp']));
				$value = $data[$type];
				if(empty($value)){
					$check = false;
				}
				if($first != 1 && $check == true){
					$stats = array($date=>$value);
				}
				elseif($check == true){
					$stats_save = $stats;
					$stats = array($date=>$value);
					$stats = $stats_save + $stats;
				}
				elseif($check == false){
					$stats = false;
				}
				$first = 1;
			}
			!isset($stats) ? $error = true : $error = false;
			!isset($stats) ? $stats = "empty" : $stats = $stats;
			return array($error, $stats);
		}
		$mysqli->close();
	}

	function getStatsAll($type, $day, $month, $year)
	{
		include "dbConnect.php";
		$check = true;
		$query = "SELECT timestamp, ROUND(avgPrice, 3) AS avgPrice FROM `avgPriceDaily` WHERE Day(timestamp) = ? AND Month(timestamp) = ? AND YEAR(timestamp) = ? AND type = ?";
		if ($stmt = $mysqli->prepare($query)) {
			$stmt->bind_param("ddds", $day, $month, $year, $type);
			$stmt->execute();
			$first = 0;
			$result = $stmt->get_result();
			while($data = $result->fetch_array()){
				$date = date("H", strtotime($data['timestamp']));
				$value = $data['avgPrice'];
				if(empty($value)){
					$check = false;
				}
				if($first != 1 && $check == true){
					$value = number_format($value, 3, '.', '');
					$stats = array($date=>$value);
				}
				elseif($check == true){
					$stats_save = $stats;
					$value = number_format($value, 3, '.', '');
					$stats = array($date=>$value);
					$stats = $stats_save + $stats;
				}
				elseif($check == false){
					$stats = false;
				}
				$first = 1;
			}
			!isset($stats) ? $error = true : $error = false;
			!isset($stats) ? $stats = "empty" : $stats = $stats;
			return array($error, $stats);
		}
		$mysqli->close();
	}
