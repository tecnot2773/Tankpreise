<?php
$url = 'https://creativecommons.tankerkoenig.de/json/detail.php'."?id=1e3c1718-bdb8-4710-8829-03fc8ca8657d&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";
$json = file_get_contents($url);
$decoded = json_decode($json);
print_r($decoded);
echo $decoded->station->name;
echo $decoded->station->brand;
 ?>
