
<!DOCTYPE html>
<html>


<script type="text/javascript">
	var locations = [

	['10.8.0.30', 45.526692, -73.660471, 0],
	['10.8.0.58', 45.526692, -73.660471, 0],
	['10.8.0.73', 45.526692, -73.660471, 0],
	['10.8.0.74', 45.526692, -73.660471, 0],
	['10.8.0.75', 45.526692, -73.660471, 0],
	['10.8.0.76', 45.526692, 73.660471, 0],
	['10.8.0.77', 45.526692, -73.660471, 0],
	['10.8.0.82', 45.526692, -73.660471, 0],
	['10.8.0.153', 45.526692, -73.660471, 0],
	['10.8.0.154', 45.526692, 73.660471, 0],
	['10.8.0.155', 45.526692, -73.660471, 0],
	['10.8.0.156', 45.526692, -73.660471, 0],
	['10.8.0.158', 45.526692, 73.660471, 0],
	['10.8.0.157', 45.526692, -73.660471, 0],
	['10.8.0.200', 45.526692, -73.660471, 0]

	];

	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 2,
		center: new google.maps.LatLng(45.526692, -73.660471),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	var infowindow = new google.maps.InfoWindow();

	var marker, i;

	for (i = 0; i < locations.length; i++) {  
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		});

		google.maps.event.addListener(marker, 'click', (function(marker, i) {
			return function() {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
			}
		})(marker, i));
	}
</script>



<?php


echo "<div id=map style=width: 1200px; height: 600px;></div>";

?>

</html>





