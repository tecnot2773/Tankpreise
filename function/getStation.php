<?php

	function getStations($address, $radius, $type)							//function getStations
	{
		include "dbConnect.php";					//new mysqli
		if($radius > 25 || $radius < 5){			//safety measures for api
			$radius = 25;
		}
		if($type == "Diesel"){			//safety measures for api
			$type = "diesel";
		}
		if($type == "E5"){			//safety measures for api
			$type = "e5";
		}
		if($type == "E10"){			//safety measures for api
			$type = "e10";
		}
		if($type != "diesel" && $type != "e5" && $type != "e10"){		//safety measures for api
			$type = "diesel";
		}
		include_once "getKoordinates.php";			//include getKoordinates
		$koordiates = getKoordinates($address, $mysqli);	//call function getKoordinates
		if(isset($koordiates)){		//if return was successful
			//include "UTF8Convert.php";
			$lat = $koordiates[0];		//save data from array
			$lng = $koordiates[1];		//save data from array

			$sort = 'price';
			$http_content = file_get_contents('https://creativecommons.tankerkoenig.de/json/list.php'
			    ."?lat=$lat"
			    ."&lng=$lng"
			    ."&rad=$radius"  // Suchradius in km
			    ."&sort=$sort"   // Sortierung: 'price' oder 'dist' - bei type=all diesen Parameter weglassen
			    ."&type=$type"   // Spritsorte: 'e5', 'e10', 'diesel' oder 'all'
			    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key

			$json = convert($http_content);		//convert UTF8 characters
			$decoded = json_decode($json);		//decode json format into array

			return $decoded;			//return the array
		}
	}
	function getName($decoded, $type)		//function getName
	{
		$nameArray = array();			//make array
		foreach($decoded->stations as $station){		//fatch array
			$name = $station->name;
			array_push($nameArray, $name);	//fill array with data
			if($type == "request"){		//if type is request
				if(!isset($station->price)){		//if price is not set
					array_pop($nameArray);			//delete last position in array !! Happens when the station dont have that type
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
	function getStations25($radius, $lat, $lng)			//function getStations25  !! Stats function
	{
		include_once "UTF8Convert.php";
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
