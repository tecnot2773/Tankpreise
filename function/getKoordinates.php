<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$address = $_POST["text-address"];

		$json = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json'
		    ."?address=$address"   // adress
		    ."&apikey=8b284941-6a9c-30c6-1f12-9791a0b841dd");   // API-Key
		$data = json_decode($json);

		preg_match('/\[location] => stdClass Object\n *\(\n *\[lat] => (.+?)(?=\n)/' , $data, $latitude);
		preg_match('/\[location] => stdClass Object\n *\(\n *\[lat] => \d*.\d*\n *\[lng] => (.+?)(?=\n)/', $json, $longitude);
		if(isset($longitude[1])){
			include_once "getPrice.php";
			getPrice($longitude[1], $latitude[1]);
		}else{
			echo "GoogleAPI overflow <br> Please reload the Page";
		}
	}
?>
