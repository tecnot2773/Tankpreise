<?php

$address = $_GET["address"];

$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json'
    ."?address=$address"   // adress
    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key
$data = json_decode($json);
print_r($data);
?>
