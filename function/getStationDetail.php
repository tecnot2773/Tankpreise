<?php

		function getDetail($UUID)
		{
			include_once "UTF8Convert.php";
			$url = 'https://creativecommons.tankerkoenig.de/json/detail.php'."?id=$UUID&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd";
			$json = file_get_contents($url);
			$json = convert($json);
			$decoded = json_decode($json);

			return $decoded;
		}
		function getName($content)
		{
			$name = $content->station->name;
			return $name;
		}
		function getBrand($content)
		{
			$brand = $content->station->brand;
			return $brand;
		}
		function getPlace($content)
		{
			$place = $content->station->place;
			return $place;
		}
		function getStreet($content)
		{
			$street = $content->station->street;
			return $street;
		}
		function getHousenumber($content)
		{
			$houseNumber = $content->station->houseNumber;
			return $houseNumber;
		}
		function getOpeningtimes($content)
		{
			if(!empty($content->station->openingTimes[0]->text)){
				$openingtxt = $content->station->openingTimes[0]->text;
				$openingstart = $content->station->openingTimes[0]->start;
				$openingend = $content->station->openingTimes[0]->end;
				$opening0 = $openingtxt . " " . $openingstart . " bis " . $openingend;
				$opening = array($opening0);
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
			if($content->station->wholeDay == 1){
				unset($opening);
				$opening = "täglich 00:00 bis 23:59";
				$opening = array($opening);
			}
			return $opening;
		}
		function getIsopen($content)
		{
			$isOpen = $content->station->isOpen;
			if($isOpen == 1){
				$isOpen = "Ja";
			}
			else{
				$isOpen = "Nein";
			}
			return $isOpen;
		}
		function getE5($content)
		{
			if(isset($content->station->e5)){
				$e5 = $content->station->e5;
				return $e5;
			}
		}
		function getE10($content)
		{
			if(isset($content->station->e10)){
				$e10 = $content->station->e10;
				return $e10;
			}
		}
		function getDiesel($content)
		{
			if(isset($content->station->diesel)){
				$diesel = $content->station->diesel;
				return $diesel;
			}
		}
 ?>
