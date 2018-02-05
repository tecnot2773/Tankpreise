<?php
	class Detail{

		public static function getDetail($UUID)
		{
			include_once "UTF8Convert.php";
			$http_content = file_get_contents('https://creativecommons.tankerkoenig.de/json/detail.php'
																		."?id=$UUID"
																		."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");

			$http_content = convert($http_content);
			return $http_content;
		}
		public static function getName($content)
		{
			preg_match_all('/"name":"\K(.+?)(?=")/', $content, $name);
			return $name;
		}
		public static function getBrand($content)
		{
			preg_match_all('/"brand":"\K(.+?)(?=")/', $content, $brand);
			return $brand;
		}
		public static function getPlace($content)
		{
			preg_match_all('/"place":"\K(.+?)(?=")/', $content, $town);
			$town = preg_replace('/"',/, $town, '');
			return $town;
		}
		public static function getStreet($content)
		{
			preg_match_all('/"street":"\K(.+?)(?=")/', $content, $street);
			$street = preg_replace('/',/, $street, '');
			return $street;
		}
		public static function getHousenumber($content)
		{
			preg_match_all('/"houseNumber":"\K(.+?)(?=")/', $content, $houseNumber);
			if(!empty($houseNumber[1][0])){
				return $houseNumber;
			}
			else{
				return false;
			}
		}
		public static function getOpeningtimes($content)
		{
			preg_match_all('/{"text":"\K(.+?)(?=")/', $content, $openingDays);
			preg_match_all('/"start":"\K(.+?)(?=")/', $content, $openingTimesStart);
			preg_match_all('/"end":"\K(.+?)(?=")/', $content, $openingTimesEnd);
			if(!empty($openingDays[1][0])){
				$opening[0] = $openingDays[1][0] . " " . $openingTimesStart[1][0] . " - " . $openingTimesEnd[1][0];
			}
			if(!empty($openingDays[1][1])){
				$opening[1] = $openingDays[1][1] . " " . $openingTimesStart[1][1] . " - " . $openingTimesEnd[1][1];
			}
			if(!empty($openingDays[1][2])){
				$opening[2] = $openingDays[1][2] . " " . $openingTimesStart[1][2] . " - " . $openingTimesEnd[1][2];
			}
			else{
				$opening[0] = "täglich 00:00 - 23:59";
			}
			return $opening;
		}
		public static function getIsopen($content)
		{
			preg_match_all('/"isOpen":\K(.+?)(?=,)/', $content, $isOpen);
			if($isOpen == true){
				$isOpen = "Ja";
			}
			else{
				$isOpen = "Nein";
			}
			return $isOpen;
		}
		public static function getE5($content)
		{
			preg_match_all('/"e5":\K(.+?)(?=,)/', $content, $e5);
			if($e5[1][0] != "null"){
				$e5 = "E5 Preis: " . $e5[1][0] . " Euro";
			}
			else{
				$e10 = "null";
			}
			return $e5;
		}
		public static function getE10($content)
		{
			preg_match_all('/"e10":\K(.+?)(?=,)/', $content, $e10);
			if($e10[1][0] != "null"){
				$e10 = "E10 Preis: " . $e10[1][0] . " Euro";
			}
			else{
				$e10 = "null";
			}
			return $e10;
		}
		public static function getDiesel($content)
		{
			preg_match_all('/"diesel":\K(.+?)(?=,)/', $content, $diesel);
			if($diesel[1][0] != "null"){
				$diesel = "Diesel Preis: " . $diesel[1][0] . " Euro";
			}
			else{
				$diesel = "null";
			}
			return $diesel;
		}


	}
 ?>
