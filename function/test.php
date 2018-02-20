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
