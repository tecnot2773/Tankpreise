<?php

	function getPrice($lng, $lat)
	{
		$radius = "5";
		//$sort = $_GET["sort"];
		$type = "all";
		$http_content = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
		    ."?lat=$lat"     // geographische Breite
		    ."&lng=$lng"     //               Länge
		    ."&rad=$radius"  // Suchradius in km
		    //."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
		    ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
		    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key ersetzen!
		//print_r($http_content);				//debug
		$data = json_decode($http_content);
		//print_r($data);					//debug
		echo "<br><br>";

		preg_match_all('/"place":"(.+?)(?=")/', $http_content, $town);
		preg_match_all('/"brand":"(.+?)(?=")/', $http_content, $brand);
		preg_match_all('/"street":"(.+?)(?=")/', $http_content, $street);
		preg_match_all('/"e5":(.+?)(?=,)/', $http_content, $e5);
		preg_match_all('/"diesel":(.+?)(?=,)/', $http_content, $diesel);

		echo "\n";

		//echo strtolower(strip_tags($name[1][1])) . "<br>";
		//echo strtolower(strip_tags($town[1][1])) . "<br>";
		$count = count($town[1]);
		for ($i = 0; $i < $count; $i++) {
			$street[1][$i] = preg_replace('/(?=\\\\u00df)(.+?)(?<=f)/', 'ß', $street[1][$i]);;

			echo "Tankstelle: " . $brand[1][$i] . "<br>\n";
			echo "Stadt: " . $town[1][$i] . "<br>\n";
			echo "Straße: " . $street[1][$i] . "<br>\n";
			echo "Super-Benzin: " . $e5[1][$i] . " Euro <br>\n";
			echo "Diesel: " . $diesel[1][$i] . " Euro <br> <br>\n";
		}

	}
?>
