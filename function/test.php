<?php
$url = 'https://creativecommons.tankerkoenig.de/json/list.php?lat=52.9127&lng=8.81814&rad=5&sort=price&type=e10&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd';
$url = 'https://creativecommons.tankerkoenig.de/json/list.php'
		."?lat=52.9127"
		."&lng=8.81814"
		."&rad=5"  // Suchradius in km
		//."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
		."&type=all"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
		."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";
$json = file_get_contents($url);
$decoded = json_decode($json);
print_r($decoded);
echo "<br><br>";



 ?>
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
