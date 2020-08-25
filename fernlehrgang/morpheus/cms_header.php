<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<head>
	<title>content-management-system - pixel-dusche.de, pixeldusche.com</title>

	<meta http-equiv="content-type" content="text/html;charset=utf-8">
	<meta name="KEYWORDS" content="webdesign gestaltung internet php mysql online-shops cms c-m-s content management individual l&ouml;sung flash programmierung frankfurt main ebusiness ecommerce neue medien new media business2business b2b benutzeroberfl&auml;chen navigation pflege-tools">
	<meta name="DESCRIPTION" CONTENT="pixel-dusche + pixeldusche.com bietet individuall&ouml;sungen f&uuml;r internetauftritte mit hohen anspruch auf gestaltung und benutzerf&uuml;hrung - einfache pflege-tools f&uuml;r den kunden und klare informationsaufbereitung der inhalte f&uuml;r seine zielgruppe">
	<meta NAME="page-topic" CONTENT="business">
	<meta NAME="audience" CONTENT="Alle">
	<meta name="ROBOTS" content="index,follow">
	<meta name="Content-Language" content="de">
	<meta name="AUTHOR" content="pixel-dusche.de, pixeldusche.com, frankfurt am main - bjoern knetter">
	<meta name="PUBLISHER" content="pixel-dusche.de, pixeldusche.com, frankfurt am main - bjoern knetter">
	<meta name="PAGE-TOPIC" content="">
	<meta name="REVISIT-AFTER" content="20 days">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../css/animate.min.css"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
    <script type="text/javascript" src="../js/vendor/jquery-1.11.0.min.js"></script>
    <script src="../js/vendor/jquery-migrate-1.2.1.min.js"></script>
    <script src="../js/vendor/jquery-ui.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>
    <script type="text/javascript" src="../js/vendor/bootstrap.min.js"></script>
    
    
    

<?php
	$op = $_GET["open"];
	echo '
	<link href=\'http://fonts.googleapis.com/css?family=Anaheim\' rel=\'stylesheet\' type=\'text/css\'>

	<link rel="stylesheet" href="css/font.css" type="text/css">
	<script type="text/javascript"> var GB_ROOT_DIR = "js/"; var start = '. ($op ? $op : 0) .' </script>
	'. ($multiupload ? '' : ' <script type="text/javascript" src="js/pixeldusche.js"></script>	') .'
	<link href="js/gb_styles.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="js/AJS.js"></script>

	<link href="js/skins/square/aero.css" rel="stylesheet">
	
	'.($form ? '' : '
	<script src="js/icheck.js"></script>
    <script src="js/init.js"></script>
<script>
$(document).ready(function(){
  $(\'input\').iCheck({
    checkboxClass: \'icheckbox_square-aero\',
    radioClass: \'iradio_square-aero\',
    increaseArea: \'20%\' // optional
  });
});
</script>
');

	$stelle = $_REQUEST["stelle"];
	$split	= $_REQUEST["split"];
	$sav	= $_REQUEST["erstellen"];

	if ($split) {
		$t 		= explode("-", $split);
		$stelle = trim($t[1]);
	}
	elseif ($sav) {
		$t 		= explode(" ", $sav);
		$stelle = trim($t[1]);
	}

	$jump = $stelle - 1;
	$multi_lang = 0;

	if ($multiupload) include("cms_header_upload.php");

?>



	<script type="text/javascript">
	<!--
		function sf(){document.nav_edit.name.focus();}
		function jump(){
			if (navigator.userAgent.search('Macintosh') == -1) {
				if (navigator.userAgent.search('MSIE') != -1) {
				// fuer ie
					var ziel = "#<?php echo $jump; ?>"; document.location.href=ziel;
				}
				else { var ziel = "#<?php echo $jump; ?>"; document.location.href=ziel;
				// klappt nicht mit firefox, netscape
				}
			}
		}
		function check (url) {
			chk = document.check.check.value;
			if (chk < 1) {
				document.location.href=url;
			} else {
				alert("Ihre &auml;nderungen waren noch nicht gespeichert.\nDie Speicherung wird jetzt vorgenommen.\nBitte wiederholen Sie Ihre gew&uuml;nschte Aktion!");
				document.content_edit.submit(); }
			}
		function setchange (x) { document.check.check.value=x; }

		function setdupl (x) { document.content_edit.duplizieren.value=x; document.content_edit.submit(); }
	// -->
	</script>
</head>

<body <?php if ($stelle) echo 'onload="jump();"'; elseif (!$multiupload)  echo ' onload="initMenu();"'; ?>>
<a name="top"></a>

	<script type="text/javascript" src="js/gb_scripts.js"></script>

<!-- deko und copyright -->

