<?php

$lat = $_GET["lat"];
$lng = $_GET["lng"];
$radius = $_GET["radius"];
$sort = $_GET["sort"];
$type = $_GET["type"];
$json = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
    ."?lat=$lat"     // geographische Breite
    ."&lng=$lng"     //               Länge
    ."&rad=$radius"  // Suchradius in km
    ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
    ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // Demo-Key ersetzen!
$data = json_decode($json);
display($data);

?>
