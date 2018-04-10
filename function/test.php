<html><head>
<title>strange bar chart</title>
<style type="text/css">
table.chart { width: 100%; }
table.chart td { 
    font-size: 8pt;
    font-family: Arial,serif; 
}
table.chart tr.barvrow td 
{ 
    height: 300px; 
    vertical-align: bottom;
    border-bottom-color: darkblue;
    border-bottom-style: solid;
    text-align: center; 
}
table.chart tr.bartrow td 
{
    text-align: center;
    width: 100px;
}
</style>
</head>
<body>
<?php 
function ae_bar_css(&$values, $height=400, $css_prefix='')
{
    $max = -1;

    foreach($values as $k=>$v)
        if (abs($v) > $max)
            $max = abs($v);
    
    if ($max != 0)
        $kf = $height / $max;
    else
        $kf = 0;

    $out = "<tr class='{$css_prefix}barvrow'>";    
    foreach($values as $k=>$v)
    {
        $bar_h = abs(round($v*$kf));
        $out .= "<td style='border-bottom-width: {$bar_h}px'>{$v}</td>";
    }
    $out .= '</tr>';
    
    
    $out .= "<tr class='{$css_prefix}bartrow'>";    

    foreach($values as $k=>$v)
        $out .= "<td>{$k}</td>";
        
    $out .= "</tr>";
    return $out;
}

?>
<? 
include "dbConnect.php";
$query = "SELECT diesel, timestamp FROM `stats` WHERE Day(timestamp) = ? AND Month(timestamp) = ? AND gasstationID = ?";
if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
	$stmt->bind_param("ddd", $day, $month, $stationID);		//bind parameters
	$day = '09';
	$month = '04';
	$stationID = '3';
	$stmt->execute();
	$first = 0;
	$result = $stmt->get_result();		//save result
		 while($data = $result->fetch_array()){
			$date = $data['timestamp'];
			$diesel = $data['diesel'];
			if($first != 1){
				$stats = array($date=>$diesel);
			}
			else{
				$stats_save = $stats;
				$stats = array($date=>$diesel);
				$stats = $stats_save + $stats;
			}
			$first = 1;
		 }
	}
echo '<table class="chart">';
echo ae_bar_css($stats, 300);
echo '</table>';
var_dump($stats);
?>
</body>
</html>
