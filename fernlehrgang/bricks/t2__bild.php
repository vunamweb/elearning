<?php
global $img_pfad, $dir, $bild, $imgCt;

$imgid  = $text;

if($text) {
	$que  	= "SELECT itext, imgname, `longtext` FROM image WHERE imgid=$imgid";
	$res 	= safe_query($que);
	$rw     = mysqli_fetch_object($res);
	$itext 	= $rw->itext;
	$ltext 	= $rw->longtext;
	$inm 	= $rw->imgname;

	$bild = '									<img src="'.$dir.'timthumb.php?w=300&amp;src='.$dir.'images/userfiles/image/'.urlencode($inm).'" alt="'.$itext.'" class="img-responsive" />
';
}
$morp = $inm;

?>