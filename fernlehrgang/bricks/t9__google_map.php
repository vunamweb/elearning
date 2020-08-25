<?php
global $bild_1_2, $google, $dir;

$tmp = explode("#", $text);
$coord = $tmp[0];
$addr = $tmp[1];
$google = 1;

$weg = "https://www.google.de/maps/dir//".$addr;

$google = '<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript">

 	var contentString = "<a href=\''.$weg.'\' target=\'_blank\'><img src=\''.$dir.'img/planer.png\' /></a>";

 	var infowindow = new google.maps.InfoWindow({
      	content: contentString
	});



	function createMap(lat, lng, zoomVal) {
	    var mapOptions ={
	        center: new google.maps.LatLng(lat, lng),
	        zoom: zoomVal,
	        scrollwheel: true,
	        zoomControl: true,
	        zoomControlOptions: {
	            position: google.maps.ControlPosition.LEFT_CENTER
	        },
	//        mapTypeId: google.maps.MapTypeId.SATELLITE,
	        mapTypeId: google.maps.MapTypeId.ROADMAP,
	//        mapTypeId: google.maps.MapTypeId.HYBRID,
	//        mapTypeId: google.maps.MapTypeId.TERRAIN,
	        styles : [{featureType:\'all\',stylers:[{saturation:-100},{gamma:0.8}]}]
	    };

	    map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

		var image = "'.$dir.'images/marker.png";
		var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(lat, lng),
	      map: map,
		  icon: image
		});
		google.maps.event.addListener(marker, \'click\', function() {
			infowindow.open(map,marker);
		});
		infowindow.open(map,marker);
	}



	var map;

	function initialize() {
	  createMap('.$coord.');
	  // console.log("here");
	}

	google.maps.event.addDomListener(window, \'load\', initialize);

</script>
';

$output .= '

                <div class="map-iframe" id="googleMap"></div>

';

$morp = 'GOOGLE MAP';

?>