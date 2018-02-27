<!-- ONLY FOR TESTING -->
<!DOCTYPE html>
<html>
	<p id="test"></p>

	<script>
		var x = document.getElementById("test");

		function getLocation() {
		    if (navigator.geolocation) {
		        navigator.geolocation.getCurrentPosition(showPosition);
		    } else {
		        x.innerHTML = "Geolocation is not supported.";
		    }
		}

		function showPosition(position) {
		    x.innerHTML = "Latitude: " + position.coords.latitude +
		    "<br>Longitude: " + position.coords.longitude;
		}
	</script>

	<body onload="getLocation()">
	</body>
</html>
