<?php
global $google;

	$output .= '
						<div id="google_map" class="google_map fullwidth"></div>
';

/*
							        markers: [{
						            address: "EISENBAHNSTRASSE 1, 65375 OESTRICH-WINKEL",
						            html: "<a href=\'https://www.google.com/maps/dir//Eisenbahnstraße+1,+65375+Oestrich-Winkel,+Deutschland/@50.00893,8.0265933,17\' target=\'_blank\'>Zum Routenplaner</a>",
						            popup: true
						        }],

	var blueMoon= [
{	featureType: "all", stylers: [ { hue: \'#0000b0\'}	] }
];
*/

$google = '

<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script type="text/javascript">


 	var contentString = "<a href=\'https://www.google.com/maps/dir//Eisenbahnstraße+1,+65375+Oestrich-Winkel,+Deutschland/@50.00893,8.0265933,17\' target=\'_blank\'><img src=\'http://www.sauerproduct.com/img/planer.png\' /></a>";

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
	        styles : [{featureType:\'all\',stylers:[{saturation:-50},{hue:\'#004B6A\'},{gamma:0.95}]}]
	    };

	    map = new google.maps.Map(document.getElementById("google_map"), mapOptions);

		var image = "http://www.sauerproduct.com/images/marker.png";
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
	  createMap(50.00893,8.0265933,11);
	  // console.log("here");
	}

	google.maps.event.addDomListener(window, \'load\', initialize);

</script>


';
?>