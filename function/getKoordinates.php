<?php

$address = $_GET["address"];

$http_content = file_get_contents("http://localhost/tankpreise/function/googleAPI.php" . "?address=$address");

preg_match('/\[location] => stdClass Object\n *\(\n *\[lat] => (.+?)(?=\n)/' , $http_content, $latitude);
preg_match('/\[location] => stdClass Object\n *\(\n *\[lat] => \d*.\d*\n *\[lng] => (.+?)(?=\n)/', $http_content, $longitude);

echo $longitude[1];
echo "</br>";
echo $latitude[1];
echo "</br>";
//https://maps.googleapis.com/maps/api/geocode/json?address=Drebber&key=AIzaSyD4uZglg9MtITh2LuBsAeYpbH2yXAiYBGw
include_once "getPrice.php";
getPrice($longitude[1], $latitude[1]);

///$key = AIzaSyD4uZglg9MtITh2LuBsAeYpbH2yXAiYBGw

 ?>
