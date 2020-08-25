<?php

$sql = "SELECT * FROM lakfaq WHERE 1 ORDER BY date DESC";
$res = safe_query($sql);

while ($row = mysqli_fetch_object($res)) {
	$output .= '
		<h1>'.$row->frage.'</h1>
		<p>'.$row->antwort.'</p>
		
		<div class="trenner"></div>
		
	';

}


?>