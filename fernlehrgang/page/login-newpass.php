<?php
# print_r($_SESSION);

global $dir, $navID;

$pw = isset($_POST["pwd"]) ? $_POST["pwd"] : '';
$un = isset($_POST["unr"]) ? $_POST["unr"] : '';

$pwA = isset($_POST["pw1"]) ? $_POST["pw1"] : '';
$pwB = isset($_POST["pw2"]) ? $_POST["pw2"] : '';
$sec = isset($_POST["sec"]) ? $_POST["sec"] : '';

$nolog = 1;
$warn = '';
$min = 6;
$youAreIn = 0;

$sessMNR = isset($_SESSION["custname"]) ? $_SESSION["custname"] : '';
$sessPASS = isset($_SESSION["pd"]) ? $_SESSION["pd"] : '';

if($sessMNR && $sessPASS) {
	$sql = "SELECT * FROM morp_kunden WHERE pass='".$sessPASS."' AND kid='".$sessMNR."' AND kontrolle=1 AND inlist=1";
	$res = safe_query($sql);
	$x = mysqli_num_rows($res);
	if($x > 0) $youAreIn = 1;
}

if($youAreIn) {

	if($pwA || $pwB) {
		$kid = holeID($sec);
		if($pwA != $pwB) $output .= '<h2>Die Passwörter stimmen nicht überein</h2><p>&nbsp;</p>'.newPW($min, $kid);
		elseif(strlen($pwA) < $min) $output .= '<h2>Das Passwort muss aus mind. '.$min.' Zeichen bestehen.</h2><p>&nbsp;</p>'.newPW($min, $kid);
		else {
			$zahl = 0;
			$zeichen = 0;
			if(preg_match("/\d/", $pwA)) $zahl = 1;
			if(preg_match("/[a-zA-Z]/", $pwA)) $zeichen = 1;
			if(!$zahl) $output .= '<h2>Das Passwort muss mind. eine Zahl enthalten.</h2><p>&nbsp;</p>'.newPW($min, $kid);
			elseif(!$zeichen) $output .= '<h2>Das Passwort muss mind. einen Buchstaben enthalten.</h2><p>&nbsp;</p>'.newPW($min, $kid);
			else {
				$sql = "UPDATE morp_kunden set kontrolle='1', pass='".md5($pwA)."', newpass=0 WHERE kid='".$kid."'";
				$res = safe_query($sql);
				$sql = "SELECT mnr FROM morp_kunden WHERE kid=$kid";
				$res = safe_query($sql);
				$row = mysqli_fetch_object($res);
				$output .= '<h2>Das Passwort wurde erfolgreich geändert.</h2><p>&nbsp;</p>';
				$_SESSION["custname"] = $row->mnr;
				$_SESSION["pd"] = md5($pwA);
			}
		}
	}
	else {
		$row = mysqli_fetch_object($res);
		$output .= newPW($min, $row->kid);
	}
}

$output = $warn.$output;

?>