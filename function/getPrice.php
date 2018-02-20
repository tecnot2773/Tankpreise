<?php

	function getStations($address, $radius, $type)
	{
		include "dbConnect.php";
		if($radius > 25){
			$radius = 25;
		}
		if($type == "Diesel"){
			$type = "diesel";
		}
		if($type == "E5"){
			$type = "e5";
		}
		if($type == "E10"){
			$type = "e10";
		}
		if($type != "diesel" && $type != "e5" && $type != "e10"){
			$type = "diesel";
		}
		include_once "getKoordinates.php";
		$koordiates = getKoordinates($address, $mysqli);
		if(isset($koordiates)){
			include_once "UTF8Convert.php";
			$lat = $koordiates[0];
			$lng = $koordiates[1];

			$sort = 'price';
			$http_content = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
			    ."?lat=$lat"
			    ."&lng=$lng"
			    ."&rad=$radius"  // Suchradius in km
			    ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
			    ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
			    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key

			$json = convert($http_content);
			$decoded = json_decode($json);

			return $decoded;
		}
	}
	function getName($decoded)
	{
		$nameArray = array();
		foreach($decoded->stations as $station){
			$name = $station->name;
			array_push($nameArray, $name);
		}
		return $nameArray;
	}
	function getPlace($decoded)
	{
		$placeArray = array();
		foreach($decoded->stations as $station){
			$place = $station->place;
			array_push($placeArray, $place);
			if(!isset($station->price)){
				array_pop($placeArray);
			}
		}
		return $placeArray;
	}
	function getBrand($decoded)
	{
		$brandArray = array();
		foreach($decoded->stations as $station){
			$brand = $station->brand;
			array_push($brandArray, $brand);
			if(!isset($station->price)){
				array_pop($brandArray);
			}
		}
		return $brandArray;
	}
	function getStreet($decoded)
	{
		$streetArray = array();
		foreach($decoded->stations as $station){
			$street = $station->street;
			array_push($streetArray, $street);
			if(!isset($station->price)){
				array_pop($streetArray);
			}
		}
		return $streetArray;
	}
	function getHousenumber($decoded)
	{
		$houseNumberArray = array();
		foreach($decoded->stations as $station){
			if(isset($station->houseNumber)){
				$houseNumber = $station->houseNumber;
				array_push($houseNumberArray, $houseNumber);
				if(!isset($station->price)){
					array_pop($houseNumberArray);
				}
			}
		}
		return $houseNumberArray;
	}
	function getUUID($decoded)
	{
		$UUIDArray = array();
		foreach($decoded->stations as $station){
			$UUID = $station->id;
			array_push($UUIDArray, $UUID);
			if(!isset($station->price)){
				array_pop($UUIDArray);
			}
		}
		return $UUIDArray;
	}
	function getPrice($decoded)
	{
		$priceArray = array();
		foreach($decoded->stations as $station){
			if(isset($station->price)){
				$price = $station->price;
				array_push($priceArray, $price);
			}
		}
		return $priceArray;
	}

?>
