<?php

$address = $_GET["address"];

$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json'
    ."?address=$address"   // adress
    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key
$data = json_decode($json);
print_r($data);
$test = $address;
//           \[location] => stdClass Object \( \[lat] => (.+?)(?= \[lng])     get lat
//          \[location] => stdClass Object \( \[lat] => \d*.\d* \[lng] => (.+?)(?= \))      get lon
$web = "http://localhost/tankpreise/getKoordinates.php" . "?address=$test";
$http_content = file_get_contents($web);
preg_match('/\[location] => stdClass Object \( \[lat] => (.+?)(?= \[lng])/' , $http_content, $latitude);
preg_match('/\[location] => stdClass Object \( \[lat] => \d*.\d* \[lng] => (.+?)(?= \))/', $http_content, $longitude);


echo "<br>";
echo $longitude;
echo "</br>" . $latitude;
//https://maps.googleapis.com/maps/api/geocode/json?address=Drebber&key=AIzaSyD4uZglg9MtITh2LuBsAeYpbH2yXAiYBGw


///$key = AIzaSyD4uZglg9MtITh2LuBsAeYpbH2yXAiYBGw



 ?>
