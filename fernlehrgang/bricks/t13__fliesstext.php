<?php
#global $slidertext;
#$slidertext = explode("\n", $text);

$text = preg_replace(array('/«/', '/»/'), array('<span class="arrow">«</span>', '<span class="arrow">»</span>'), $text);
$output .= '<p>'.nl2br($text).'</p>';
# $morp = $text;

?>