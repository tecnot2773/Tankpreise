<?php

	function getStations($address, $radius, $type)
	{
		include "dbConnect.php";					//database connection
		if($radius > 25 || $radius < 5){			//savety because max radius should be 25 and min radius should be 5
			$radius = 25;
		}
		if($type == "Diesel"){					// types are Diesel, E5 or E10, if it is something else, it is set to Diesel
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
		list($error, $koordiates) = getKoordinates($address, $mysqli);		//get koordiates for given address
		$decoded = "false";
		if(isset($koordiates) && $error == "OK"){			//only if error is "OK"
			//include "UTF8Convert.php";
			$lat = $koordiates[0];		//koordiates1 == lat
			$lng = $koordiates[1];		//koordiates2 == lng

			$sort = 'price';
			$url = 'https://creativecommons.tankerkoenig.de/json/list.php'
			    ."?lat=$lat"
			    ."&lng=$lng"
			    ."&rad=$radius"  // Suchradius in km
			    ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
			    ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
			    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";   // API-Key
			$http_content = curl_get_contents($url);

			$json = convert($http_content);				//call API to get Prices
			$decoded = json_decode($json);				//decode JSON format
		}
		return array($error, $decoded);				//return the decoded data, and the error if there is one
	}
	function getName($decoded, $type)
	{
		$nameArray = array();						//set nameArray to array type
		foreach($decoded->stations as $station){		//
			$name = $station->name;
			array_push($nameArray, $name);			//fill array with names
			if($type == "request"){				//if type == request
				if(!isset($station->price)){	// and price is not set
					array_pop($nameArray);	//delete last element of array, this is needed because the API sets the Price to 0 if the Station dont has the SpritType
				}
			}
		}
		return $nameArray;			//return filled array
	}
	function getPlace($decoded, $type)	//everything below is same as the function above
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
	function getStations25($lat, $lng, $radius)
	{
		include_once "UTF8Convert.php";
		$type = "all";	//get all but without best price check

		$url = 'https://creativecommons.tankerkoenig.de/json/list.php'
				."?lat=$lat"
				."&lng=$lng"
				."&rad=$radius"  // Suchradius in km
				//."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
				."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
				."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";
		$http_content = curl_get_contents($url);   // API-Key


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
