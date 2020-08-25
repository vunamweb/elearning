<?php


$text = explode("\n", $text);
$output .= '
					<ul class="dots">';

foreach($text as $val) {
	if ($val) $output .= "		<li>$val</li>";
}
$output .= '				</ul>

';
?>