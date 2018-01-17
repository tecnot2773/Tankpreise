<?php

$address = $_GET["address"];

//           \[location] => stdClass Object \( \[lat] => (.+?)(?= \[lng])     get lat
//          \[location] => stdClass Object \( \[lat] => \d*.\d* \[lng] => (.+?)(?= \))      get lon
$web = "http://localhost/tankpreise/googleAPI.php" . "?address=$address";

$http_content = file_get_contents($web);
print_r ($http_content);

preg_match('/\[location] => stdClass Object \( \[lat] => (.+?)(?= \[lng])/' , $http_content, $latitude);
preg_match('/\[location] => stdClass Object \( \[lat] => \d*.\d* \[lng] => (.+?)(?= \))/', $http_content, $longitude);


echo "<br>";
print_r ($longitude);
echo "</br>";
print_r ($latitude);
//https://maps.googleapis.com/maps/api/geocode/json?address=Drebber&key=AIzaSyD4uZglg9MtITh2LuBsAeYpbH2yXAiYBGw


///$key = AIzaSyD4uZglg9MtITh2LuBsAeYpbH2yXAiYBGw



 ?>
