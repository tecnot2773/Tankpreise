<?php
$address = "blender";
$url = 'https://maps.googleapis.com/maps/api/geocode/json'."?address=$address&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";		//get koordinates via googleAPI
$json = file_get_contents($url);
$decoded = json_decode($json);
print_r($decoded);
echo "<br><br>";
$land = $decoded->results[0]->address_components[3]->long_name;		//get longitude from array
echo $decoded->status;
if(isset($decoded->results[0]->address_components[2]->long_name)){$land = $decoded->results[0]->address_components[2]->long_name;}	//check if address is in Germany
if(isset($decoded->results[0]->address_components[3]->long_name) && $land != "Germany"){$land = $decoded->results[0]->address_components[3]->long_name;}
if(isset($decoded->results[0]->address_components[4]->long_name) && $land != "Germany"){$land = $decoded->results[0]->address_components[4]->long_name;}
echo $land;
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
