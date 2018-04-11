<?php

		function getDetail($UUID)	//function getDetail
		{
			include_once "UTF8Convert.php";
			$url = 'https://creativecommons.tankerkoenig.de/json/detail.php'."?id=$UUID&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";
			$json = file_get_contents($url);
			$json = convert($json);		//convert UTF8
			$decoded = json_decode($json);		//decode json

			return $decoded;		//return array
		}
		function getName($content)
		{
			$name = $content->station->name;		//get name from array
			return $name;
		}
		function getBrand($content)
		{
			$brand = $content->station->brand;		//get brand from array
			return $brand;
		}
		function getPlace($content)
		{
			$place = $content->station->place;		//get place from array
			return $place;
		}
		function getStreet($content)
		{
			$street = $content->station->street;		//get street from array
			return $street;
		}
		function getHousenumber($content)
		{
			$houseNumber = $content->station->houseNumber;		//get houseNumber from array
			return $houseNumber;
		}
		function getOpeningtimes($content)
		{
			if(!empty($content->station->openingTimes[0]->text)){		//if text is not empty
				$openingtxt = $content->station->openingTimes[0]->text;		//get text
				$openingstart = $content->station->openingTimes[0]->start;		//get start
				$openingend = $content->station->openingTimes[0]->end;			//get end
				$opening0 = $openingtxt . " " . $openingstart . " bis " . $openingend;		//build string
				$opening = array($opening0);			//fill array
			}
			if(!empty($content->station->openingTimes[1]->text)){
				$openingtxt = $content->station->openingTimes[1]->text;
				$openingstart = $content->station->openingTimes[1]->start;
				$openingend = $content->station->openingTimes[1]->end;
				$opening1 = $openingtxt . " " . $openingstart . " bis " . $openingend;
				unset($opening);
				$opening = array($opening0, $opening1);
			}
			if(!empty($content->station->openingTimes[2]->text)){
				$openingtxt = $content->station->openingTimes[2]->text;
				$openingstart = $content->station->openingTimes[2]->start;
				$openingend = $content->station->openingTimes[2]->end;
				$opening2 = $openingtxt . " " . $openingstart . " bis " . $openingend;
				unset($opening);
				$opening = array($opening0, $opening1, $opening2);
			}
			if($content->station->wholeDay == 1){		//if station is open the whole day
				unset($opening);
				$opening = "täglich 00:00 bis 23:59";
				$opening = array($opening);
			}
			return $opening;		//return array
		}
		function getIsopen($content)	//function getIsopen
		{
			$isOpen = $content->station->isOpen;
			if($isOpen == 1){	//if station is currently open
				$isOpen = "Ja";
			}
			else{				//if not
				$isOpen = "Nein";
			}
			return $isOpen;
		}
		function getE5($content)
		{
			if(isset($content->station->e5)){	//if station has e5
				$e5 = $content->station->e5;
				return $e5;
			}
		}
		function getE10($content)
		{
			if(isset($content->station->e10)){	//if station has e10
				$e10 = $content->station->e10;
				return $e10;
			}
		}
		function getDiesel($content)
		{
			if(isset($content->station->diesel)){	//if station has diesel
				$diesel = $content->station->diesel;
				return $diesel;
			}
		}
		function getStationName($id)
		{
			include "../function/dbConnect.php";
			$sql = "SELECT name FROM gasstation WHERE ID = ?";		//query to get ID from city
			if ($stmt = $mysqli->prepare($sql)) {			//prepare statement
				$stmt->bind_param("s", $id);			//bind parameter
				$stmt->execute();							//execute statement
				$result = $stmt->get_result();				//save result
				if($result->num_rows >= 1){
					while($data = $result->fetch_array()){		//fetch array
						$name = $data["name"];			//save id in cityID
					}
				}
			}
			$mysqli->close();
		}
 ?>
