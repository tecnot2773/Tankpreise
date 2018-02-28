<?php
include_once "dbConnect.php";
$query = "SELECT avg(diesel) AS diesel FROM stats WHERE MONTH(timestamp) = ? AND DAY(timestamp) = ? AND YEAR(timestamp) = ? AND HOUR(timestamp) = ?;";
if ($stmt = $mysqli->prepare($query)) {		//prepare statement to get stats
	$stmt->bind_param("ssss", $month, $day, $year, $hour);		//bind parameters
	$day = date("d", strtotime("last Monday"));		//day from last monday
	$month = date("m", strtotime("last Monday"));	//month from last monday
	$year = date("Y", strtotime("last Monday"));	//year from last monday
	for($i = 0; $i < 24; $i++){
		$hour = $i;
		//echo "SELECT avg(diesel) AS diesel FROM stats WHERE MONTH(timestamp) = $month AND DAY(timestamp) = $day AND YEAR(timestamp) = $year AND HOUR(timestamp) = $hour;";
		$stmt->execute();			//execute statement
		$result = $stmt->get_result();		//save result
		 while($data = $result->fetch_array()){
			 $diesel = $data["diesel"];

			 echo $diesel . "<br>";
		}
	}
}

/*
https://stackoverflow.com/questions/8994718/mysql-longitude-and-latitude-query-for-other-rows-within-x-mile-radius
SELECT radius
SELECT
    `ID`,
    (
        6371 *
        acos(
            cos( radians( 52.9127 ) ) *
            cos( radians( `lat` ) ) *
            cos(
                radians( `lon` ) - radians( 8.81814 )
            ) +
            sin(radians(52.9127)) *
            sin(radians(`lat`))
        )
    ) `distance`
FROM
    `gasstation`
HAVING
    `distance` < 5
ORDER BY
    `distance`
LIMIT
    25
	*/
?>
