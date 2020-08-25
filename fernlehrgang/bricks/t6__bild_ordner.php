<?php
global $img_pfad, $dir, $bild, $imgCt;

$imgid  = $text;

if($text) {
	$que  	= "SELECT itext, imgname, `longtext` FROM image i, img_group g WHERE i.gid=g.gid AND g.gid=$imgid ORDER BY imgname";
	$res 	= safe_query($que);

	$imgCt = 0;

	while ($rw = mysqli_fetch_object($res)) {
		$imgCt++;
		$itext 	= $rw->itext;
		$ltext 	= $rw->longtext;
		$inm 	= $rw->imgname;

		$output .= '                            <div class="item'.($imgCt < 2 ? ' active' : '').'">
                              <img src="'.$dir.'images/userfiles/image/'.urlencode($inm).'" alt="'.($itext ? $itext : $inm).'" />
                            </div>
';
	}
}
$morp = $inm;

?>