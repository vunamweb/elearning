<?php

$tmp 	= explode("|", $text);
$link 	= $tmp[0];
$txt 	= $tmp[1];

$output .= "<p><a href=\"". (isin("^http://", $link) ? '' : 'http://') .$link."\" target=\"_blank\">$txt</a></p>
";

?>