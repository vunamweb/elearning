<?php
$jq = '';
$box = '';
global	$mylink;

			include("../nogo/config.php");
			include("../nogo/config_morpheus.inc");
			include("inc/de.php");
//			include("inc/morp_function.php");

if ($box) 	include("cms_header_gb.php");
elseif ($jq) 	include("cms_header_jquery.php");
else		include("cms_header.php");
			include("../nogo/db.php");
dbconnect();
			include("login.php");
			include("../nogo/funktion.inc");
            include("../fckeditor/fckeditor.php");
            //include("../dompdf/autoload.inc.php");



// if ($shop)	include("../nogo/shop.inc");
if (!$box) 	include("cms_navigation.php");
include("filter_language.php");

# redaktions- / live-system muss noch ermoeglicht werden
?>