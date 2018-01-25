<?php

	function getPrice($lng, $lat, $radius, $type)
	{
		include_once "UTF8Convert.php";

		//$sort = $_GET["sort"];
		//$type = "all";
		$sort = 'price';
		$http_content = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
		    ."?lat=$lat"
		    ."&lng=$lng"
		    ."&rad=$radius"  // Suchradius in km
		    ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
		    ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
		    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key
		//print_r($http_content);				//debug
		//print_r(json_decode($http_content));

		$http_content = convert($http_content);

		global $town, $street, $houseNumber, $move;
		preg_match_all('/"place":"\K(.+?)(?=")/', $http_content, $town);
		preg_match_all('/"brand":"\K(.+?)(?=")/', $http_content, $brand);
		preg_match_all('/"street":"\K(.+?)(?=")/', $http_content, $street);
		preg_match_all('/"houseNumber":"\K(.+?)(?=")/', $http_content, $houseNumber);
		preg_match_all('/"price":\K(.+?)(?=,)/', $http_content, $price);
		echo "\n";
		
		$count = count($town[1]);
		$move = 0;
		for ($i = 0; $i < $count; $i++) {
			if($price[1][$i] != "null"){
				$houseNumber[1][$i] = preg_replace('/",/', '', $houseNumber[1][$i]);

				echo "Tankstelle: " . $brand[1][$i] . "<br>\n";
				echo "Stadt: " . $town[1][$i] . "<br>\n";
				echo "Straße: " . $street[1][$i] . " ";
				if(!empty($houseNumber[1][$i])){ echo $houseNumber[1][$i]; }
				echo "<br>\n" . $type . ": " . $price[1][$i] . " Euro <br> <br>\n";
			}
			else{
				unset($town[1][$i]);
				unset($brand[1][$i]);
				unset($street[1][$i]);
				unset($houseNumber[1][$i]);
				unset($price[1][$i]);
				$move++;
			}
		}
	}
?>
