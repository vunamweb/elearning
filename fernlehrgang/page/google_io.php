<?php
global $google;
$google = 1;

	$output .= '
				<div class="">
					<div class="resizable_block">
						<div id="google_map" class="google_map fullwidth"></div>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function () {
						    jQuery("#google_map").gMap({
						        markers: [{
						            address: "Dr.-Ottmar-Kohler-Straße 2, 55743 Idar-Oberstein",
						            html: "<a href=\'https://www.google.de/maps/dir//Dr.-Ottmar-Kohler-Straße 2, 55743 Idar-Oberstein/@49.716236,7.32173,15\' target=\'_blank\'>Zum Routenplaner</a>",
						            popup: true
						        }],
						        zoom: 15,
						        maptype: google.maps.MapTypeId.ROADMAP,
						        scrollwheel: false,
						        mapTypeControl: false,
						        zoomControl: true,
						        panControl: false,
						        scaleControl: false,
						        streetViewControl: false
						    });
						});
					</script>
				</div>
';
?>