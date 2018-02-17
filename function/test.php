<?php
$address = "kiel";
$url = 'https://maps.googleapis.com/maps/api/geocode/json'."?address=$address&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";
$json = file_get_contents($url);
$decoded = json_decode($json);
echo $decoded->results[0]->address_components[0]->long_name;
echo $longitude = $decoded->results[0]->geometry->location->lng;
echo $latitude = $decoded->results[0]->geometry->location->lat;
 ?>
