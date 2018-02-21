<?php

	function getStations($address, $radius, $type)
	{
		include "dbConnect.php";
		if($radius > 25 || $radius < 5){
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
		include "getKoordinates.php";
		$koordiates = getKoordinates($address, $mysqli);
		if(isset($koordiates)){
			//include "UTF8Convert.php";
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
	function getName($decoded, $type)
	{
		$nameArray = array();
		foreach($decoded->stations as $station){
			$name = $station->name;
			array_push($nameArray, $name);
			if($type == "request"){
				if(!isset($station->price)){
					array_pop($placeArray);
				}
			}
		}
		return $nameArray;
	}
	function getPlace($decoded, $type)
	{
		$placeArray = array();
		foreach($decoded->stations as $station){
			$place = $station->place;
			array_push($placeArray, $place);
			if($type == "request"){
				if(!isset($station->price)){
					array_pop($placeArray);
				}
			}
		}
		return $placeArray;
	}
	function getBrand($decoded, $type)
	{
		$brandArray = array();
		foreach($decoded->stations as $station){
			$brand = $station->brand;
			array_push($brandArray, $brand);
			if($type == "request"){
				if(!isset($station->price)){
					array_pop($brandArray);
				}
			}
		}
		return $brandArray;
	}
	function getStreet($decoded, $type)
	{
		$streetArray = array();
		foreach($decoded->stations as $station){
			$street = $station->street;
			array_push($streetArray, $street);
			if($type == "request"){
				if(!isset($station->price)){
					array_pop($streetArray);
				}
			}
		}
		return $streetArray;
	}
	function getHousenumber($decoded, $type)
	{
		$houseNumberArray = array();
		foreach($decoded->stations as $station){
			if(isset($station->houseNumber)){
				$houseNumber = $station->houseNumber;
				array_push($houseNumberArray, $houseNumber);
				if($type == "request"){
					if(!isset($station->price)){
						array_pop($houseNumberArray);
					}
				}
			}
		}
		return $houseNumberArray;
	}
	function getUUID($decoded, $type)
	{
		$UUIDArray = array();
		foreach($decoded->stations as $station){
			$UUID = $station->id;
			array_push($UUIDArray, $UUID);
			if($type == "request"){
				if(!isset($station->price)){
					array_pop($UUIDArray);
				}
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
// from here its for the stats
	function getStations25()
	{
		include_once "UTF8Convert.php";
		$lat = "52.9127"; 		//Syke
		$lng = "8.81814";
		$radius = "25";			//25km -- maximum
		$type = "all";	//get all but without best price check


		$http_content = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
				."?lat=$lat"
				."&lng=$lng"
				."&rad=$radius"  // Suchradius in km
				//."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
				."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
				."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key


		$json = convert($http_content);
		$decoded = json_decode($json);

		return $decoded;
	}
	function getE5($decoded)
	{
		$E5Array = array();
		foreach($decoded->stations as $station){
			$E5 = $station->e5;
			array_push($E5Array, $E5);
		}
		return $E5Array;
	}
	function getE10($decoded)
	{
		$E10Array = array();
		foreach($decoded->stations as $station){
			$E10 = $station->e10;
			array_push($E10Array, $E10);
		}
		return $E10Array;
	}
	function getDiesel($decoded)
	{
		$dieselArray = array();
		foreach($decoded->stations as $station){
			$diesel = $station->diesel;
			array_push($dieselArray, $diesel);
		}
		return $dieselArray;
	}
	function getLat($decoded)
	{
		$latArray = array();
		foreach($decoded->stations as $station){
			$lat = $station->lat;
			array_push($latArray, $lat);
		}
		return $latArray;
	}
	function getLon($decoded)
	{
		$lonArray = array();
		foreach($decoded->stations as $station){
			$lon = $station->lng;
			array_push($lonArray, $lon);
		}
		return $lonArray;
	}
?>
