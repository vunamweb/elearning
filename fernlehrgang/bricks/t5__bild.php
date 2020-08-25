<?php
global $img_pfad, $dir, $bild, $imgCt;

$imgid  = $text;
if(!$imgCt) $imgCt=1;
else $imgCt++;

if($text) {
	$que  	= "SELECT itext, imgname, `longtext` FROM image WHERE imgid=$imgid";
	$res 	= safe_query($que);
	$rw     = mysqli_fetch_object($res);
	$itext 	= $rw->itext;
	$ltext 	= $rw->longtext;
	$inm 	= $rw->imgname;

	$output .= '        <div id="slide'.$imgCt.'" class="land parallax '.($imgCt>1 ? 'not_' : '').'shown" style="background-image:url('.$img_pfad.$inm.')">
        </div>
';
}
$morp = $inm;

?>