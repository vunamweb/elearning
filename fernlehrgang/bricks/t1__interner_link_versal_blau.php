<?php
global $navarray, $lan, $navID;

$tmp 	= explode("|", $text);
$anker 	= explode("#", $tmp[0]);
$link 	= trim($anker[0]);
$anker	= $anker[1];
$txt 	= $tmp[1];


//$output .= 'ilink<a class="btn2" href="'.$dir.$navID[$link].'"><span class="fa '.($islock ? 'fa-lock' : 'fa-external-link-square').'"></span> '.$txt.'</a>ilink';
$output .= '<h1 class="versal"><a href="'.$dir.$navID[$link].'">'.$txt.'</a></h1>';

?>