<?php


$text = explode("\n", $text);
$output .= '
					<ul class="versal">';

foreach($text as $val) {
	if ($val) $output .= "		<li>$val</li>";
}
$output .= '				</ul>

';
?>