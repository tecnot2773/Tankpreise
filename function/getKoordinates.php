<?php
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$address = $_POST["text-address"];

		$http_content = file_get_contents("http://localhost/tankpreise/function/googleAPI.php" . "?address=$address");

		preg_match('/\[location] => stdClass Object\n *\(\n *\[lat] => (.+?)(?=\n)/' , $http_content, $latitude);
		preg_match('/\[location] => stdClass Object\n *\(\n *\[lat] => \d*.\d*\n *\[lng] => (.+?)(?=\n)/', $http_content, $longitude);
		if(isset($longitude[1])){
			include_once "getPrice.php";
			getPrice($longitude[1], $latitude[1]);
		}else{
			echo "GoogleAPI overflow <br> Please reload the Page";
		}
	}
?>
