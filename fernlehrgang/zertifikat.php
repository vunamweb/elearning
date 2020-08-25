<?php

session_start();
error_reporting(none);
include("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();

include("nogo/config.php");
include("nogo/funktion.inc");
include("nogo/db.php");
dbconnect();


/* Prüfe ob User bestanden ***************************************************/
	$sql = "SELECT test FROM `user_test_active` WHERE id_user = ".$_SESSION[id_user]." ORDER BY `test` DESC LIMIT 0,1";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);
	$test = $row->test;
	if($test < 6) die("Keine Berechtigung!");
/* _________________ Prüfe ob User bestanden */



/* Lese Daten User aus *******************************************************/
	$sql="SELECT * FROM  user WHERE uid =".$_SESSION[id_user]."";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);

	$Vorname=$row->Vorname.' '.$row->Name;
	$address=$row->Strasse.' '.$row->Hausnummer.', '.$row->Plz.' '.$row->ort.' ';
	$gerbu=$row->Geburtsdatum;


	$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <style>

   @font-face {
        font-family: Univers-55;
        src: url(../dompdf/Univers/Univers.otf);
   }

  html { margin: 0px 30px;  font-family:Univers-55; }
  body {  font-family:Univers-55; }
 .body{margin-top:105px; font-family:arial; }

 .text{padding-bottom:28px; font-size:18px; color:#000; margin-left: 70px; font-family:Univers-55; }
 .text-detail{font-weight:bold;color:#000;position:absolute;top:160px}

 .pdf{width:100%;margin:0 auto; position:absolute; top:-1000px; }
 .datum { margin-left: 70px; margin-top:412px; font-family:Univers-55; font-size:18px; }
  </style>
</head>
<body>
		<img src="images/zertifikat.png" style="width:100%; margin-top:50px;" />
<div>';
$html.='
       <div class="pdf">

           <div class="body">
             <div class="text" style="padding-bottom:31px;">'.$Vorname.'</div>
             <div class="text">'.$address.'</div>
             <div class="text">'.$gerbu.'</div>


             <div class="datum">10.02.2023</div>
		  </div>
      </div>
       ';


$dompdf->loadHtml( $html );
$dompdf->setPaper( 'A4', 'Horizontal' );
$dompdf->render();
$dompdf->stream( 'zertifikat.pdf' );
exit();


?>